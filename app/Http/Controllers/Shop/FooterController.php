<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;

class FooterController extends Controller
{
    public function helpCenter()
    {
        $shop = Shop::first();
        return view('client.pages.footer.help-center', compact('shop'));
    }

    public function getStart()
    {
        $shop = Shop::first();
        return view('client.pages.footer.help.getting-started', compact('shop'));
    }


    public function termsAndCondition()
    {
        $shop = Shop::first();
        return view('client.pages.footer.terms-and-condition', compact('shop'));
    }

    public function privacy()
    {
        $shop = Shop::first();
        return view('client.pages.footer.privacy', compact('shop'));
    }

    public function aboutUs()
    {
        $shop = Shop::first();
        return view('client.pages.footer.about-us', compact('shop'));
    }
}
