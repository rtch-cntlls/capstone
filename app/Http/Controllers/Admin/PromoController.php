<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\PromoService;

class PromoController extends Controller
{
    protected PromoService $promoService;

    public function __construct(PromoService $promoService)
    {
        $this->promoService = $promoService;
    }

    public function index(Request $request) 
    {
        try {
            $status = $request->get('status', 'all');

            $promo = $status === 'all'
                ? $this->promoService->getAllPromos()
                : $this->promoService->getPromosByStatus($status);

            $cards = $this->promoService->getPromoCards();

            return view('admin.pages.promo.index', compact('promo', 'cards'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function create()
    {
        try {
            $products = $this->promoService->getProductsWithoutPromo();

            return view('admin.pages.promo.create', compact('products'));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string',
            'promo_type'       => 'required|in:single,bundle',
            'discount_percent' => 'required|numeric|min:1|max:100',
            'start_date'       => 'required|date',
            'expiry_date'      => 'required|date|after:start_date',
            'product_ids'      => 'required|array|min:1',
        ], [
            'product_ids.required' => 'Please select at least one product.',
            'product_ids.min'      => 'Please select at least one product.',
        ]);

        try {
            $this->promoService->createPromo($request);
            return redirect()->route('admin.promo.index')->with('success', 'Promo applied to selected products.');
        } catch (\Throwable $e) {
            report($e); 
            dd($request->all());
            return response()->view('error.admin500');
        }
    }
    
    public function reactivate(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after:start_date',
        ]);

        $this->promoService->reactivatePromo($id, $request->start_date, $request->expiry_date);

        return redirect()->route('admin.promo.index')->with('success', 'Promo reactivated successfully.');
    }
}
