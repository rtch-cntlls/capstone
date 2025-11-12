<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoService
{
    /**
     * Update expired promos automatically
     */
    protected function updateExpiredPromos(): void
    {
        Discount::where('status', '!=', 'Expired')
            ->where('expiry_date', '<', now()->toDateString())
            ->update(['status' => 'Expired']);
    }

    /**
     * Determine the status of a promo based on start and expiry dates
     */
    protected function determineStatus(string $startDate, string $expiryDate): string
    {
        $today = now()->toDateString();
        if ($today < $startDate) {
            return 'Upcoming';
        } elseif ($today >= $startDate && $today <= $expiryDate) {
            return 'Active';
        } else {
            return 'Expired';
        }
    }

    /**
     * Get all promos with automatic expired update
     */
    public function getAllPromos()
    {
        $this->updateExpiredPromos();
        return Discount::with('products')->paginate(10);
    }

    /**
     * Get promos filtered by status
     */
    public function getPromosByStatus(string $status)
    {
        $this->updateExpiredPromos();
        return Discount::with('products')
            ->when($status != 'all', fn($q) => $q->where('status', $status))
            ->paginate(10);
    }

    /**
     * Get products not in any promo
     */
    public function getProductsWithoutPromo(int $perPage = 9)
    {
        return Product::doesntHave('discount')->paginate($perPage);
    }

    /**
     * Create a new promo
     */
    public function createPromo(Request $request): void
    {
        DB::transaction(function () use ($request) {
            $status = $this->determineStatus($request->start_date, $request->expiry_date);

            $discount = Discount::create([
                'title'            => $request->title,
                'discount_percent' => $request->discount_percent,
                'start_date'       => $request->start_date,
                'expiry_date'      => $request->expiry_date,
                'status'           => $status,
            ]);

            $discount->products()->sync($request->product_ids);
        });
    }

    /**
     * Reactivate a promo with new dates
     */
    public function reactivatePromo(int $id, string $startDate, string $expiryDate)
    {
        $promo = Discount::findOrFail($id);

        $status = $this->determineStatus($startDate, $expiryDate);

        $promo->update([
            'start_date'  => $startDate,
            'expiry_date' => $expiryDate,
            'status'      => $status,
        ]);
    }

    /**
     * Get dashboard promo cards
     */
    public function getPromoCards(): array
    {
        $this->updateExpiredPromos(); // ensure accurate counts
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
}
