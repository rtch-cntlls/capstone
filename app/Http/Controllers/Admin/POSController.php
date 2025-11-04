<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\Admin\POSService;

class POSController extends Controller
{
    protected $posService;

    public function __construct(POSService $posService)
    {
        $this->posService = $posService;
    }

    public function index(Request $request)
    {
        try {
            $product = $this->posService->getProducts($request->search, $request->category);
            $categories = $this->posService->getCategories();
            $cart = $this->posService->getCart();

            return view('admin.pages.pos.index', compact('product', 'categories', 'cart'));
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function addToCart(Product $product)
    {
        try {
            $this->posService->addToCart($product);
            return back();
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function removeFromCart(Product $product)
    {
        try {
            $this->posService->removeFromCart($product);
            return back();
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function checkout(Request $request)
    {
        try {
            $cart = $this->posService->getCart();
    
            if (empty($cart)) {
                return redirect()->back()->with('error', 'Cart is empty.');
            }
    
            $validated = $request->validate([
                'amount_paid' => 'required|numeric|min:0',
                'change'      => 'nullable|numeric|min:0',
            ]);
    
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            if ($validated['amount_paid'] < $subtotal) {
                return redirect()->back()
                    ->with('error', 'Insufficient payment amount. Please enter an amount equal to or greater than the total.')
                    ->withInput();
            }
    
            $sale = $this->posService->POScheckout(
                $cart,
                $validated['amount_paid'],
                $validated['change'] ?? 0 
            );
    
            return redirect()->back()->with('success', 'Sale transaction completed successfully!');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }    
}