<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\FacebookLoginService;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    protected $fbService;

    public function __construct(FacebookLoginService $fbService)
    {
        $this->fbService = $fbService;
    }

    public function redirect()
    {
        return $this->fbService->redirect();
    }

    public function callback(Request $request)
    {
        return $this->fbService->handleCallback($request);
    }
}
