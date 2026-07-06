@extends('layouts.admin')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title">お米在庫詳細</h2>
</div>

<div class="table-card">
    <table class="table detail-table align-middle">
        <tr>
            <th>品種</th>
            <td>{{ $product->variety }}</td>
        </tr>
        <tr>
            <th>5kg在庫</th>
            <td class="{{ $product->stock_5kg == 0 ? 'text-danger fw-bold' : '' }}">{{ $product->stock_5kg }}袋</td>
        </tr>
        <tr>
            <th>10kg在庫</th>
            <td class="{{ $product->stock_10kg == 0 ? 'text-danger fw-bold' : '' }}">{{ $product->stock_10kg }}袋</td>
        </tr>
        <tr>
            <th>20kg在庫</th>
            <td class="{{ $product->stock_20kg == 0 ? 'text-danger fw-bold' : '' }}">{{ $product->stock_20kg }}袋</td>
        </tr>
        <tr>
            <th>30kg在庫</th>
            <td class="{{ $product->stock_30kg == 0 ? 'text-danger fw-bold' : '' }}">{{ $product->stock_30kg }}袋</td>
        </tr>
        <tr>
            <th>5kg価格</th>
            <td>{{ $product->price_5kg }}円</td>
        </tr>
        <tr>
            <th>10kg価格</th>
            <td>{{ $product->price_10kg }}円</td>
        </tr>
        <tr>
            <th>20kg価格</th>
            <td>{{ $product->price_20kg }}円</td>
        </tr>
        <tr>
            <th>30kg価格</th>
            <td>{{ $product->price_30kg }}円</td>
        </tr>
        <tr>
            <th>説明</th>
            <td>{{ $product->description }}</td>
        </tr>
    </table>
</div>

<a href="{{ route('products.edit', $product) }}" class="btn btn-primary">編集</a>
<form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')

    <button type="submit" class="btn btn-danger" onclick="return confirm('品種「{{ $product->variety }}」を削除しますか？')">
        削除
    </button>
</form>
<a href="{{ route('products.index') }}" class="btn btn-outline-secondary">一覧へ戻る</a>

@endsection