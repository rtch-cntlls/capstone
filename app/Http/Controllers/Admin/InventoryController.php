<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\InventoryService;
use Illuminate\Http\Request;
use App\Models\Product;

class InventoryController extends Controller
{
    public function __construct(protected InventoryService $inventoryService) {}

    public function index(Request $request)
    {
        try {
            return view('admin.pages.inventory.index', $this->inventoryService->summaryCards($request));
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function storeFromProduct(Product $product, int $quantity, int $reorderLevel)
    {
        try {
            $this->inventoryService->storeProduct($product, $quantity, $reorderLevel);
            return back()->with('success', 'Product inventory created!');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function create(Request $request, int $id)
    {
        $validated = $request->validate(['stock_quantity' => 'required|integer|min:1']);

        try {
            $this->inventoryService->addStock($id, $validated['stock_quantity']);
            return back()->with('success', 'Stock added successfully!');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function show(int $id)
    {
        try {
            $inventory = $this->inventoryService->getStockHistory($id);
            $card = $this->inventoryService->inventoryCard($inventory);

            return view('admin.pages.inventory.show', compact('inventory', 'card'));
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function update(Request $request, $product_id)
    {
        $validated = $request->validate(['product_name' => 'required|string|max:100']);
        try {
            $this->inventoryService->Updateproduct($request, $product_id);
            return back()->with('success', 'Product name updated successfully.');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function exportPDF(int $id)
    {
        try {
            return $this->inventoryService->exportInventoryPDF($id)->download('inventory-report.pdf');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function exportAllPDF()
    {
        try {
            return $this->inventoryService->exportAllInventoriesPDF()->download('inventory_report.pdf');
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }

    public function exportAllCSV()
    {
        try {
            return $this->inventoryService->exportAllInventoriesCSV();
        } catch (\Throwable $e) {
            report($e);
            return response()->view('error.admin500');
        }
    }
}