<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethods;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethods::all();
        return view('admin.pages.setting.payment', compact('methods'));
    }

    public function update(Request $request, PaymentMethods $method)
    {
        $data = $request->validate([
            'enabled' => 'nullable|boolean',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'account_email' => 'nullable|email|max:255',
            'qr_code' => 'nullable|image|max:2048',
        ]);

        $data['enabled'] = $request->has('enabled');

        if ($request->hasFile('qr_code')) {
            $data['qr_code_path'] = $request->file('qr_code')->store('qr_codes', 'public');
        }

        $method->update($data);

        return back()->with('success', $method->name.' updated successfully.');
    }

}
