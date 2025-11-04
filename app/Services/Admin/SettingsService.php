<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Shop;
use App\Models\PaymentMethods;

class SettingsService
{
    public function getAuthenticatedAdmin(): User
    {
        return Auth::user();
    }

    public function updateOrderSettings(Request $request, int $id): void
    {
        DB::transaction(function () use ($request, $id) {
            $shop = Shop::findOrFail($id);

            if ($request->has('service_area')) {
                $shop->update([
                    'service_area' => $request->input('service_area'),
                ]);
            }
            foreach ($request->except(['_token', 'shipping_fee']) as $field => $value) {
                $shop->update([
                    $field => $value === 'on' ? 1 : $value,
                ]);
            }

            if ($request->has('shipping_fee')) {
                foreach ($request->shipping_fee as $region => $fee) {
                    $column = "shipping_fee_{$region}";
                    if (in_array($column, [
                        'shipping_fee_local',
                        'shipping_fee_province',
                        'shipping_fee_visayas',
                        'shipping_fee_luzon',
                        'shipping_fee_mindanao',
                    ])) {
                        $shop->update([
                            $column => is_numeric($fee) ? $fee : 0,
                        ]);
                    }
                }
            }

            $methods = [
                'gcash' => 'GCash',
                'cod'   => 'Cash on Delivery',
            ];
    
            foreach ($methods as $key => $name) {
                PaymentMethods::updateOrCreate(
                    ['name' => $name],
                    ['enabled' => $request->boolean("payment_$key")]
                );
            }
        });
    }

    public function updateStoreDetails(Request $request, int $id): void
    {
        DB::transaction(function () use ($request, $id) {
            $shop = Shop::findOrFail($id);

            if ($request->has('shop_name')) {
                $shop->update(['shop_name' => $request->shop_name]);
            }

            $addressData = $request->only(['province', 'city', 'barangay']);
            if (!empty(array_filter($addressData))) {
                $shop->update($addressData);
            }

            if ($request->hasFile('shop_logo')) {
                $file = $request->file('shop_logo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);

                if ($shop->shop_logo && File::exists(public_path('images/' . $shop->shop_logo))) {
                    File::delete(public_path('images/' . $shop->shop_logo));
                }

                $shop->update(['shop_logo' => $filename]);
            }
        });
    }

    public function updateAdminAccount(Request $request, int $id): void
    {
        DB::transaction(function () use ($request, $id) {
            $admin = User::findOrFail($id);

            $admin->update([
                'firstname' => $request->input('admin_first_name'),
                'lastname'  => $request->input('admin_last_name'),
                'email'     => $request->input('admin_email'),
            ]);
        });
    }

    public function changePassword(Request $request): bool
    {
        $admin = Auth::user();
        if (!Hash::check($request->current_password, $admin->password)) {
            return false;
        }
        DB::transaction(function () use ($request, $admin) {
            $admin->password = Hash::make($request->new_password);
            $admin->save();
        });
        return true;
    }
}
