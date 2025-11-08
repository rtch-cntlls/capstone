<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Services\Shop\ShopService;
use App\Services\Shop\ChatService;
use App\Services\Shop\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Shop;

class ShopController extends Controller
{
    protected $shopService;
    protected $chatService;
    protected $productDetailsService;

    public function __construct(ShopService $shopService, ChatService $chatService, ProductService $productDetailsService)
    {
        $this->shopService = $shopService;
        $this->chatService = $chatService;
        $this->productDetailsService = $productDetailsService;
    }

    public function index()
    {
        try {
            $path = public_path('motorcycle/MotorcycleData.json');
            $brands = [];
            
            if (file_exists($path)) {
                $json = file_get_contents($path);
                $brands = json_decode($json, true);
            }
            
            $chatData = ['messages' => collect(), 'receiverId' => null];
            if (Auth::check()) {
                $chatData = $this->chatService->getMessagesWithAdmin();
            }
            $categories = Category::all();
        
            $shop = Shop::first();
            return view('client.pages.shop.index', array_merge(compact('categories','brands', 'shop'),$chatData));
            
        } catch (\Exception) {
            abort(500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string|max:1000',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpeg,jpg,png,gif,webp,mp4,mov,avi,wmv,mpeg,3gp|max:20480',
        ]);

        if (!$request->filled('content') && !$request->hasFile('attachments')) {
            return back()->withErrors(['content' => 'Please type a message or attach a file.'])->with('chat_open', true);
        }

        $this->chatService->sendMessage($request->receiver_id, $request->content, $request->file('attachments', []));
        return back()->with('chat_open', true);
    }

    public function poll()
    {
        $chatData = $this->chatService->getMessagesWithAdmin();
        return response()->json($chatData['messages']);
    }

    public function products(Request $request)
    {
        try {
            $products = $this->shopService->getProducts($request->all());
            return response()->json($products);
        } catch (\Exception) {
            return response()->view('error.shop500');
        }
    }

    public function showDetails($product_id, Request $request)
    {
        try {
            $data = $this->productDetailsService->getProductDetails(
                $product_id,
                $request->has('fullDescription')
            );
    
            return view('client.pages.shop.details', $data);
        } catch (\Exception) {
            return response()->view('error.shop500');
        }
    }
}