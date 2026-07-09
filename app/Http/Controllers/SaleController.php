<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * 販売登録画面
     */
    public function create()
    {
        $productStocks = ProductStock::with('product')
            ->orderBy('crop_year', 'desc')
            ->get();

        return view('sales.create', compact('productStocks'));
    }

    /**
     * 販売登録
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_stock_id' => 'required|exists:product_stocks,id',
            'sale_date' => 'required|date',
            'customer_name' => 'nullable|string|max:255',
            'size' => 'required|in:5,10,20,30',
            'quantity' => 'required|integer|min:1',
            'sale_method' => 'nullable|in:,引取,配達,発送,その他',
            'note' => 'nullable|string',
        ]);

        $productStock = ProductStock::with('product')
            ->findOrFail($request->product_stock_id);

        $stockColumn = 'stock_' . $request->size . 'kg';
        $priceColumn = 'price_' . $request->size . 'kg';

        if ($productStock->$stockColumn < $request->quantity) {
            return back()
                ->withErrors([
                    'quantity' => '在庫が不足しています。'
                ])
                ->withInput();
        }

        $unitPrice = $productStock->product->$priceColumn;
        $totalPrice = $unitPrice * $request->quantity;

        $productStock->$stockColumn -= $request->quantity;
        $productStock->save();

        Sale::create([
            'product_stock_id' => $request->product_stock_id,
            'sale_date' => $request->sale_date,
            'customer_name' => $request->customer_name,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'sale_method' => $request->sale_method,
            'note' => $request->note,
        ]);

        return redirect()
            ->route('sales.index')
            ->with('success', '販売登録しました。');
    }

    /**
     * 販売履歴一覧
     */
    public function index(Request $request)
    {
        $query = Sale::with('productStock.product');

        if ($request->filled('sale_date')) {
            $query->where('sale_date', $request->sale_date);
        }

        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        if ($request->filled('variety')) {
            $query->whereHas('productStock.product', function ($q) use ($request) {
                $q->where('variety', 'like', '%' . $request->variety . '%');
            });
        }

        if ($request->filled('crop_year')) {
            $query->whereHas('productStock', function ($q) use ($request) {
                $q->where('crop_year', $request->crop_year);
            });
        }

        $hasSearch = $request->filled('sale_date')
            || $request->filled('customer_name')
            || $request->filled('variety')
            || $request->filled('crop_year');

        $totalAmount = $hasSearch
            ? (clone $query)->sum('total_price')
            : null;

        $sales = $query->latest()
            ->paginate(10);

        return view('sales.index', compact('sales', 'totalAmount', 'hasSearch'));
    }
}