<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Shop\CartService;
use App\Services\Shop\WishlistService;
use App\Models\Shop;

class CartController extends Controller
{
    protected CartService $cartService;
    protected WishlistService $wishlistService;

    public function __construct(CartService $cartService, WishlistService $wishlistService)
    {
        $this->cartService = $cartService;
        $this->wishlistService = $wishlistService;
    }

    public function toggleSelection(Request $request)
    {
        $productId = (int) $request->input('product_id');
        $selected  = (bool) $request->input('selected');
    
        try {
            $this->cartService->toggleSelection($productId, $selected);
            return redirect()->back();
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to update selection.');
        }
    }
    
    public function show()
    {
        if (!Auth::check() || Auth::user()->role_id != 2) {
            return redirect()->route('auth.customer.login');
        }
    
        $shop = Shop::first();
        $cartItems = $this->cartService->getCartItems();
        $selectedItems = $this->cartService->getSelectedItems();
    
        return view('client.pages.cart.index', compact('cartItems', 'selectedItems', 'shop'));
    }
    

    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity  = $request->quantity;

        if (Auth::check() && Auth::user()->role_id == 2) {
            try {
                $this->cartService->addToCart($productId, $quantity);
                $this->wishlistService->removeFromWishlist($productId);
                return redirect()->back()->with('success', 'Product added to cart.');
            } catch (\Exception) {
                return response()->view('error.shop500');
            }
        }

        $cart = session()->get('cart_pending', []);
        $cart[$productId]['quantity'] = ($cart[$productId]['quantity'] ?? 0) + $quantity;
        $cart[$productId]['product_id'] = $productId;

        session(['cart_pending' => $cart]);

        return redirect()->route('auth.customer.login');
    }

    public function removeFromCart(Request $request)
    {
        $productId = (int) $request->input('product_id');

        try {
            $this->cartService->removeFromCart($productId);
            return redirect()->back()->with('success', 'Product removed from cart.');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to remove product.');
        }
    }

    public function checkoutSelected()
    {
        $selectedItems = $this->cartService->getSelectedItems();

        if ($selectedItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No products selected for checkout.');
        }
        $orderData = $selectedItems->map(function($item) {
            return [
                'product_id'   => $item->product_id,
                'product_name' => $item->product->product_name,
                'image'        => $item->product->image,
                'price'        => $item->discounted_price,
                'quantity'     => $item->quantity,
                'discount'     => 0,
                'subtotal'     => $item->discounted_price * $item->quantity,
            ];
        })->toArray();

        session(['cart_checkout' => $orderData]);

        foreach ($selectedItems as $item) {
            $this->cartService->removeFromCart($item->product_id);
        }
        
        return redirect()->route('checkout.checkout');
    }
}
