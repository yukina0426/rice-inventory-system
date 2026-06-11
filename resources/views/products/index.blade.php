@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>お米在庫一覧</h2>

    <a href="{{ route('products.create') }}" class="btn btn-primary">
        新規登録
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('products.index') }}" method="GET" class="row g-2 mb-3">
    <div class="col-md-6">
        <input
            type="text"
            name="keyword"
            value="{{ request('keyword') }}"
            class="form-control"
            placeholder="品種名で検索"
        >
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">
            検索
        </button>
    </div>

    <div class="col-auto">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            クリア
        </a>
    </div>
</form>

<p class="text-muted">
    全{{ $products->total() }}件
</p>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
        <tr>
            <th>品種</th>
            <th>5kg</th>
            <th>10kg</th>
            <th>20kg</th>
            <th>30kg</th>
            <th>操作</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->variety }}</td>
                <td class="{{ $product->stock_5kg == 0 ? 'text-danger fw-bold' : '' }}">
                    {{ $product->stock_5kg }}
                </td>
                <td class="{{ $product->stock_10kg == 0 ? 'text-danger fw-bold' : '' }}">
                    {{ $product->stock_10kg }}
                </td>
                <td class="{{ $product->stock_20kg == 0 ? 'text-danger fw-bold' : '' }}">
                    {{ $product->stock_20kg }}
                </td>
                <td class="{{ $product->stock_30kg == 0 ? 'text-danger fw-bold' : '' }}">
                    {{ $product->stock_30kg }}
                </td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">
                        詳細
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">
                    該当する商品がありません。
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $products->withQueryString()->links() }}

@endsection