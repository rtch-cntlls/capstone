<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoService
{
    public function getAllPromos()
    {
        return Discount::with('products')->where('status', 'active')->paginate(10);
    }

    public function getProductsWithoutPromo(int $perPage = 9)
    {
        return Product::doesntHave('discount')->paginate($perPage);
    }

    public function createPromo(Request $request): void
    {
        DB::transaction(function () use ($request) {
            $today = now()->toDateString();
            $startDate = $request->start_date;
            $expiryDate = $request->expiry_date;
    
            $status = now()->lt(now()->parse($startDate)) ? 'Upcoming' 
                    : (now()->between(now()->parse($startDate), now()->parse($expiryDate)) ? 'Active' 
                    : 'Expired');
    
            $discount = Discount::create([
                'title'            => $request->title,
                'promo_type'       => $request->promo_type,
                'discount_percent' => $request->discount_percent,
                'start_date'       => $startDate,
                'expiry_date'      => $expiryDate,
                'status'           => $status,
            ]);
    
            $discount->products()->sync($request->product_ids);
        });
    }

    public function getPromosByStatus(string $status)
    {
        return Discount::with('products')
            ->where('status', $status)
            ->paginate(10);
    }

    public function getPromoCards(): array
    {
        $allPromos = Discount::all();

        $activeCount   = $allPromos->where('status', 'Active')->count();
        $upcomingCount = $allPromos->where('status', 'Upcoming')->count();
        $expiredCount  = $allPromos->where('status', 'Expired')->count();

        return [
            [
                'title' => 'Active',
                'value' => $activeCount,
                'type'  => 'Promos',
                'icon'  => 'fas fa-bolt',
                'color' => 'text-success',
            ],
            [
                'title' => 'Upcoming',
                'value' => $upcomingCount,
                'type'  => 'Promos',
                'icon'  => 'fas fa-clock',
                'color' => 'text-info',
            ],
            [
                'title' => 'Expired',
                'value' => $expiredCount,
                'type'  => 'Promos',
                'icon'  => 'fas fa-ban',
                'color' => 'text-secondary',
            ],
        ];
    }
    
    public function reactivatePromo(int $id, string $startDate, string $expiryDate)
    {
        $promo = Discount::findOrFail($id);
        $promo->update([
            'start_date' => $startDate,
            'expiry_date' => $expiryDate,
            'status' => 'Active',
        ]);
    }
}
