<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Http\Requests\ProductStockRequest;

class ProductStockController extends Controller
{
    public function create()
    {
        $products = Product::orderBy('variety')->get();

        return view('product_stocks.create', compact('products'));
    }

    public function store(ProductStockRequest $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'crop_year' => 'required|integer|min:2000|max:2100',
            'stock_5kg' => 'required|integer|min:0',
            'stock_10kg' => 'required|integer|min:0',
            'stock_20kg' => 'required|integer|min:0',
            'stock_30kg' => 'required|integer|min:0',
        ]);

        ProductStock::create($validated);

        return redirect()
            ->route('product-stocks.index')
            ->with('success', '年度在庫を登録しました。');
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $cropYear = $request->input('crop_year');

        $query = ProductStock::with('product');

        if (!empty($keyword)) {
            $query->whereHas('product', function ($q) use ($keyword) {
                $q->where('variety', 'like', '%' . $keyword . '%');
            });
        }

        if (!empty($cropYear)) {
            $query->where('crop_year', $cropYear);
        }

        $stocks = $query
            ->orderBy('crop_year', 'desc')
            ->paginate(10);

        return view('product_stocks.index', compact('stocks'));
    }

    public function edit(ProductStock $productStock)
    {
        $products = Product::orderBy('variety')->get();

        return view('product_stocks.edit', compact('productStock', 'products'));
    }

    public function update(ProductStockRequest $request, ProductStock $productStock)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'crop_year' => 'required|integer|min:2000|max:2100',
            'stock_5kg' => 'required|integer|min:0',
            'stock_10kg' => 'required|integer|min:0',
            'stock_20kg' => 'required|integer|min:0',
            'stock_30kg' => 'required|integer|min:0',
        ]);

        $productStock->update($validated);

        return redirect()
            ->route('product-stocks.index')
            ->with('success', '年度在庫を更新しました。');
    }

    public function destroy(ProductStock $productStock)
    {
        $productStock->delete();

        return redirect()
            ->route('product-stocks.index')
            ->with('success', '年度在庫を削除しました。');
    }
}
