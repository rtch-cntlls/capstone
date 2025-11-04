<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function submitGcashProof(Request $request)
    {
        $orderId = session('checkout_order_id');
        $order = Order::find($orderId);

        if (!$order || $order->payment_method !== 'gcash') {
            return redirect()->route('checkout.checkout')->with('error','Invalid order.');
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $file = $request->file('payment_proof');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('payment',$filename,'public');
        $order->payment_proof = $path;
        $order->payment_status = 'pending';
        $order->save();

        Session::forget(['checkout_order_id','checkout_payment_method']);

        return redirect()->route('order.index')->with('success','Payment proof submitted. Waiting for verification.');
    }
}
