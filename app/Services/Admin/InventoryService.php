<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\InventoryHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InventoryService
{
    public function summaryCards(Request $request): array
    {
        $query = Product::with(['category', 'inventory']);
        $query->when($request->status, function ($q, $status) {
            return match ($status) {
                'in_stock'     => $q->whereHas('inventory', fn($inv) => $inv->where('stock_status', 'in_stock')),
                'low_stock'    => $q->whereHas('inventory', fn($inv) => $inv->where('stock_status', 'low_stock')),
                'out_of_stock' => $q->whereHas('inventory', fn($inv) => $inv->where('stock_status', 'out_of_stock')),
                default        => $q,
            };
        });

        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->search;
            $q->where('product_name', 'like', "%$search%")
              ->orWhereHas('category', fn($cat) => $cat->where('name', 'like', "%$search%"));
        });

        $products = $query->paginate(10)->appends($request->query());

        $stockCounts = Inventory::selectRaw("
                SUM(CASE WHEN stock_status = 'in_stock' THEN 1 ELSE 0 END) as inStock,
                SUM(CASE WHEN stock_status = 'low_stock' THEN 1 ELSE 0 END) as lowStock,
                SUM(CASE WHEN stock_status = 'out_of_stock' THEN 1 ELSE 0 END) as outStock
            ")->first();

        return [
            'products'       => $products,
            'totalProducts'  => Product::count(),  
            'totalCategory'  => Category::count(),
            'inStock'        => $stockCounts->inStock,
            'lowStock'       => $stockCounts->lowStock,
            'outStock'       => $stockCounts->outStock,
            'cards'          => [
                ['title' => 'Product Category', 'icon' => 'fas fa-list', 'value' => Category::count(), 'type' => 'categories', 'color' => 'text-primary'],
                ['title' => 'In Stock', 'icon' => 'fas fa-inbox', 'value' => $stockCounts->inStock, 'type' => 'product/s', 'color' => 'text-success'],
                ['title' => 'Low Stock', 'icon' => 'fas fa-triangle-exclamation', 'value' => $stockCounts->lowStock, 'type' => 'product/s', 'color' => 'text-warning'],
                ['title' => 'Out of Stock', 'icon' => 'fas fa-ban', 'value' => $stockCounts->outStock, 'type' => 'product/s', 'color' => 'text-danger'],
            ]
        ];
    }
 
    public function storeProduct(Product $product, int $quantity, string $stockStatus): Inventory
    {
        return DB::transaction(function () use ($product, $quantity, $stockStatus) {
            $inventory = Inventory::create([
                'product_id'      => $product->product_id,
                'instock'         => $quantity,
                'available_stock' => $quantity,
                'stock_status'    => $stockStatus,
            ]);

            InventoryHistory::create([
                'inventory_id'   => $inventory->inventory_id,
                'quantity'       => $quantity,
                'action_date'    => now(),
            ]);

            return $inventory;
        });
    }

    public function addStock(int $inventoryId, int $quantity): Inventory
    {
        return DB::transaction(function () use ($inventoryId, $quantity) {
            $inventory = Inventory::findOrFail($inventoryId);

            $previousStock = $inventory->instock;

            $inventory->instock += $quantity;
            $inventory->available_stock += $quantity;

            if ($inventory->instock <= 0) {
                $inventory->stock_status = 'out_of_stock';
            } elseif ($inventory->instock < 3) {
                $inventory->stock_status = 'low_stock';
            } else {
                $inventory->stock_status = 'in_stock';
            }

            $inventory->save();

            InventoryHistory::create([
                'inventory_id'    => $inventory->inventory_id,
                'starting_stock'  => $previousStock,
                'quantity'        => $quantity,
                'action_date'     => now(),
            ]);

            return $inventory;
        });
    }
    
    public function getStockHistory(int $id): Inventory
    {
        return Inventory::with(['histories' => fn($q) => $q->latest('action_date'), 'product'
        ])->findOrFail($id);
    }

    public function inventoryCard(Inventory $inventory): array
    {
        $price = $inventory->product->sale_price;
        $totalValue = $inventory->instock * $price;
        return [
            [
                'icon' => 'fas fa-box-open',
                'title' => 'Stock Summary',
                'items' => [
                    ['label' => 'Total Stock', 'color' => 'text-primary', 'border' => 'border-primary', 'value' => "{$inventory->instock} item/s"],
                    ['label' => 'Available Stock', 'color' => 'text-success', 'border' => 'border-success', 'value' => "{$inventory->available_stock} item/s"],
                    ['label' => 'Sold Quantity', 'color' => 'text-info', 'border' => 'border-info', 'value' => "{$inventory->product->saleItems()->sum('quantity')} item/s"],
                ]
            ],
            [
                'icon' => 'fas fa-bell', 'title' => 'Stock Thresholds',
                'items' => [
                    ['label' => 'Reorder Level', 'value' => "{$inventory->reorder_level} item/s"],
                ]
            ],
            [
                'icon' => 'fas fa-coins', 'title' => 'Stock Value',
                'items' => [
                    ['label' => 'Total Value', 'value' => number_format($totalValue, 2)],
                ]
            ],
            [
                'icon' => 'fas fa-sync-alt', 'title' => 'Stock Activity',
            ]
        ];
    }

    public function Updateproduct(Request $request, int $product_id)
    {
        return DB::transaction(function () use ($request, $product_id) {
            $product = Product::findOrFail($product_id);
            if ($request->has('product_name')) {
                $product->update(['product_name' => $request->product_name]);
            }
        });
    }

    public function exportInventoryPDF(int $id)
    {
        $inventory = Inventory::with('product.category')->findOrFail($id);
        $totalValue = $inventory->instock * $inventory->product->cost_price;

        return Pdf::loadView('admin.pages.inventory.pdf.pdf', compact('inventory', 'totalValue'));
    }

    public function exportAllInventoriesPDF()
    {
        $products = Product::with('inventory')->get();

        return Pdf::loadView('admin.pages.inventory.pdf.all', compact('products'))
                  ->setPaper('a4', 'portrait');
    }

    public function exportAllInventoriesCSV()
    {
        $products = Product::with('inventory', 'category')->get();

        $response = new StreamedResponse(function () use ($products) {
            $handle = fopen('php://output', 'w');
            
            fputcsv($handle, [
                'Inventory ID', 'Product Name', 'Category', 'Available Stock', 
                'Stock Status', 'Cost Price', 'Sale Price', 'Date Added'
            ]);
            foreach ($products as $product) {
                fputcsv($handle, [
                    $product->inventory->inventory_id ?? 'N/A',
                    $product->product_name,
                    $product->category->name ?? 'N/A',
                    $product->inventory->available_stock ?? 'N/A',
                    ucfirst(str_replace('_', ' ', $product->inventory->stock_status ?? 'out_of_stock')),
                    number_format($product->cost_price ?? 0, 2),
                    number_format($product->sale_price ?? 0, 2),
                    optional($product->created_at)->format('M d, Y'),
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="inventory_report.csv"');

        return $response;
    }
}