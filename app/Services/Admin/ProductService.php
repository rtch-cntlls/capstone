<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\InventoryController;
use App\Services\Api\MotorcycleAIService;
use App\Services\Admin\InventoryService;

class ProductService
{
    public function getAllProducts()
    {
        return Product::with('category')->get();
    }

    public function getProductsWithFilters(Request $request, $perPage = 10)
    {
        $today = now()->toDateString();
        $query = Product::with(['category', 'discounts' => function($q) use ($today) {
            $q->where('status', 'Active')
            ->where('start_date', '<=', $today)
            ->where('expiry_date', '>=', $today);
        }]);
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                ->orWhereHas('category', fn($c) => $c->where('name', 'like', "%{$search}%"));
            });
        }
        if ($request->filled('status')) {
            $status = strtolower($request->input('status'));
            if (in_array($status, ['active', 'inactive'])) {
                $query->where('status', $status);
            }
        }
        return $query->paginate($perPage)->appends($request->only('search'));
    }

    public function getCards(): array
    {
        $data = [
            'condition' => Product::where('condition', 'new')->count(),
            'active'    => Product::where('status', 'active')->count(),
            'inactive'  => Product::where('status', 'inactive')->count(),
        ];

        return [
            [
                'title' => 'New Products', 'icon'  => 'fas fa-star', 'value' => $data['condition'],
                'type'  => 'product/s', 'color' => 'text-primary',
            ],
            [
                'title' => 'Active', 'icon'  => 'fas fa-circle-check', 'value' => $data['active'],
                'type'  => 'item/s', 'color' => 'text-success',
            ],
            [
                'title' => 'Inactive', 'icon'  => 'fas fa-circle-xmark', 'value' => $data['inactive'],
                'type'  => 'item/s', 'color' => 'text-danger',
            ],
        ];
    }

    public function createProduct(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
            }
    
            $description = $request->description;
            if (empty($description)) {
                $aiService = app(MotorcycleAIService::class);
                $description = $aiService->generateDescription($request->name);
            }
            
            $specs = $request->input('specs') ? json_encode(json_decode($request->input('specs'))) : null;

            $product = Product::create([
                'product_name' => $request->name,
                'description'  => $description,
                'category_id'  => $request->category_id,
                'cost_price'   => $request->cost_price,
                'sale_price'   => $request->sale_price,
                'weight_kg'    => $request->weight_kg,
                'material'     => $request->material, 
                'color_finish' => $request->color_finish,
                'specs'        => $specs,
                'image'        => $imagePath,
                'status'       => 'active', 
            ]);
    
            $stockStatus = $request->quantity >= 3 ? 'in_stock' : 'low_stock';
          
            $inventoryService = app(InventoryService::class);
            $inventoryService->storeProduct(
                $product,
                (int) $request->quantity,
                $stockStatus
            );            
    
            return $product;
        });
    }
    
    public function toggleStatus(Product $product): Product
    {
        $product->status = $product->status === 'Active' ? 'Inactive' : 'Active';
        $product->save();

        return $product;
    }

    public function calculateProductInsights(Product $product): array
    {
        $description = $product->description;

        $instock     = $product->inventory->instock ?? 0;
        $unitPrice   = $product->sale_price ?? 0;
        $costPrice   = $product->cost_price ?? 0;

        $discount         = $product->discounts->first();
        $discountPercent  = $discount->discount_percent ?? 0;
        $promoPrice       = $unitPrice - ($unitPrice * ($discountPercent / 100));

        $totalValue    = $unitPrice * $instock;
        $possibleProfit = ($unitPrice - $costPrice) * $instock;
        $markup        = $costPrice > 0 ? (($unitPrice - $costPrice) / $costPrice) * 100 : 0;
        $profitMargin  = $unitPrice > 0 ? (($unitPrice - $costPrice) / $unitPrice) * 100 : 0;

        return compact('description', 'discount', 'promoPrice',
            'totalValue', 'possibleProfit', 'markup', 'profitMargin'
        );
    }

    public function applyDiscount(Product $product, Request $request): Discount
    {
        return DB::transaction(function () use ($product, $request) {
            $start = now()->parse($request->start_date);
            $end   = now()->parse($request->expiry_date);
    
            $status = now()->lt($start) ? 'upcoming' 
                    : (now()->between($start, $end) ? 'Active' 
                    : 'expired');

            if ($start->isToday()) {
                $status = 'active';
            }
    
            $discount = Discount::create([
                'title'            => 'Single Product Discount',
                'discount_percent' => $request->discount_percent,
                'start_date'       => $request->start_date,
                'expiry_date'      => $request->expiry_date,
                'status'           => $status,
            ]);
    
            $product->discounts()->attach($discount->discount_id);
    
            return $discount;
        });
    }
    
}
