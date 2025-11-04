<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        $shop = Shop::first();

        $adminEmail = User::where('role_id', 1)->value('email');
        return view('client.pages.contact.index', compact('shop', 'adminEmail'));
    }
}
