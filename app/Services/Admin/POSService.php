<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class POSService
{
    public function getProducts($search = null, $category = null, $perPage = 9)
    {
        $today = now()->toDateString();
    
        $query = Product::where('status', 'Active')
            ->with(['discounts' => function ($q) use ($today) {
                $q->where('status', 'Active')
                  ->where('start_date', '<=', $today)
                  ->where('expiry_date', '>=', $today);
            }, 'inventory']);
    
        if ($search) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }
    
        if ($category) {
            $query->where('category_id', $category);
        }
    
        return $query->paginate($perPage);
    }
    
    public function getCategories()
    {
        return Category::all();
    }

    public function getCart()
    {
        return Session::get('cart', []);
    }

    public function addToCart(Product $product)
    {
        $today = now()->toDateString();

        $validDiscount = $product->discounts()
            ->where('status', 'Active')
            ->where('start_date', '<=', $today)
            ->where('expiry_date', '>=', $today)
            ->first();

        $price = $validDiscount
            ? $product->sale_price - ($product->sale_price * ($validDiscount->discount_percent / 100))
            : $product->sale_price;

        $inventory = $product->inventory;

        if (!$inventory || $inventory->available_stock <= 0) {
            return; 
        }

        $cart = Session::get('cart', []);
        if (isset($cart[$product->product_id])) {
            $cart[$product->product_id]['quantity']++;
        } else {
            $cart[$product->product_id] = [
                "name" => $product->product_name,
                "price" => $price,
                "quantity" => 1,
                "discount" => $validDiscount ? $validDiscount->discount_percent : 0,
            ];
        }

        Session::put('cart', $cart);

        $inventory->decrement('available_stock', 1);
        $this->updateStockStatus($inventory);
    }

    public function removeFromCart(Product $product)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$product->product_id])) {
            $quantity = $cart[$product->product_id]['quantity'];

            $product->inventory->increment('available_stock', $quantity);
            $this->updateStockStatus($product->inventory);

            unset($cart[$product->product_id]);
            Session::put('cart', $cart);
        }
    }

    public function POScheckout($cart, $amountPaid, $change)
    {
        return DB::transaction(function () use ($cart, $amountPaid, $change) {
            $subtotal = 0;
    
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
    
            $sale = Sale::create([
                'sale_type'     => 'walk_in',
                'sale_date'     => now(),
                'amount_pay'    => $amountPaid,
                'change'        => $change,
                'grand_total'   => $subtotal,
            ]);
            
            foreach ($cart as $productId => $item) {
                SaleItem::create([
                    'sale_id'    => $sale->sale_id,
                    'product_id' => $productId,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                    'discount'   => $item['discount'] ?? 0, 
                    'total'      => $item['price'] * $item['quantity'],
                ]);
            }

            Session::forget('cart'); 
            return $sale;
        });
    }

    private function updateStockStatus($inventory)
    {
        if ($inventory->available_stock <= 0) {
            $inventory->stock_status = 'out_of_stock';
        } elseif ($inventory->available_stock < 3) {
            $inventory->stock_status = 'low_stock';
        } else {
            $inventory->stock_status = 'in_stock';
        }
        $inventory->save();
    }
}
