<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ProductService;
use App\Models\Product;
use App\Models\Category;
use PDF;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        try {
            $products = $this->productService->getProductsWithFilters($request);
            $cards    = $this->productService->getCards();
            $search   = $request->input('search');

            return view('admin.pages.product.index', compact('products', 'cards', 'search'));
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function create()
    {
        try {
            $categories = Category::orderBy('name')->get(['category_id', 'name']);
            return view('admin.pages.product.create', compact('categories'));
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'category_id'   => 'required|exists:categories,category_id',
            'cost_price'    => 'required|numeric',
            'sale_price'    => 'required|numeric|gte:cost_price',
            'weight_kg'     => 'required|numeric|min:0',
            'quantity'      => 'required|integer',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'material'      => 'nullable|string',
            'color_finish'  => 'nullable|string',
            'compatible_models' => 'nullable|string|max:1000',
            'specs'         => 'nullable|string',
        ], [], [
            'category_id' => 'category',
        ]);        

        try {
            $this->productService->createProduct($request);
            return redirect()->route('admin.product.create')
                ->with('success_redirect', 'Product published successfully!');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function updatePricing(Request $request, $id)
    {
        $request->validate([
            'cost_price'        => 'required|numeric|min:0',
            'sale_price'        => 'required|numeric|gte:cost_price',
            'weight_kg'         => 'required|numeric|min:0',
            'material'          => 'nullable|string|max:255',
            'color_finish'      => 'nullable|string|max:255',
            'compatible_models' => 'nullable|string|max:1000',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'sale_price.gte' => 'The sale price must be greater than or equal to the cost price.',
        ]);

        try {
            $product = Product::findOrFail($id);

            $payload = [
                'cost_price'        => $request->cost_price,
                'sale_price'        => $request->sale_price,
                'weight_kg'         => $request->weight_kg,
                'material'          => $request->material,
                'color_finish'      => $request->color_finish,
                'compatible_models' => $request->compatible_models,
            ];
            
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $destinationPath = public_path('products');

                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true); 
                }

                $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

                $moved = $request->file('image')->move($destinationPath, $filename);
            
                if ($moved) {
                    $payload['image'] = 'products/' . $filename;

                    if ($product->image && file_exists(public_path($product->image))) {
                        @unlink(public_path($product->image));
                    }
                } 
            }                     
            $product->update($payload);

            return back()->with('success', 'Product updated successfully.');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function status($id)
    {
        try {
            $product = Product::findOrFail($id);
            $updated = $this->productService->toggleStatus($product);

            return back()->with('success', "Product status changed to {$updated->status}.");
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function show($id, Request $request)
    {
        try {
            $product = Product::with(['reviews.customer.user', 'reviews.replies.admin'])->findOrFail($id);
            $insights = $this->productService->calculateProductInsights($product);

            return view('admin.pages.product.show', array_merge(['product' => $product], $insights));
        } catch (\Exception $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function discount($id, Request $request)
    {
        $request->validate([
            'discount_percent' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:start_date',
        ]);

        try {
            $product = Product::findOrFail($id);
            $this->productService->applyDiscount($product, $request);

            return redirect()->back()->with('success', 'Discount applied successfully.');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function exportPdf()
    {
        $products = $this->productService->getAllProducts();
        $pdf = PDF::loadView('admin.pages.product.export-pdf', compact('products'));
        return $pdf->download('products.pdf');
    }

    public function exportCsv()
    {
        $products = $this->productService->getAllProducts();
        $filename = 'products.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Name', 'Category', 'Status', 'Cost Price', 'Sale Price', 'In-stock']);

        foreach ($products as $product) {
            fputcsv($handle, [
                $product->product_id,
                $product->product_name,
                $product->category->name ?? '',
                $product->status,
                $product->cost_price,
                $product->sale_price,
                $product->inventory->instock
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
