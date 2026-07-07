@extends('layouts.admin')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title">お米在庫一覧</h2>

    <a href="{{ route('products.create') }}" class="btn btn-primary">
        新規登録
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="search-card">
    <form action="{{ route('products.index') }}" method="GET" class="row g-2">
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
</div>

<div class="table-card">
    <p class="text-muted">
        全{{ $products->total() }}件
    </p>
    <table class="table inventory-table align-middle">
        <thead class="table-light">
            <tr>
                <th>品種</th>
                <th>説明</th>
                <th>5kg価格</th>
                <th>10kg価格</th>
                <th>20kg価格</th>
                <th>30kg価格</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->variety }}</td>
                    <td class="description-column">
                        {{ $product->description }}

                    </td>
                    <td class="{{ $product->price_5kg == 0 ? 'text-danger fw-bold' : '' }}">
                        {{ $product->price_5kg }}円
                    </td>
                    <td class="{{ $product->price_10kg == 0 ? 'text-danger fw-bold' : '' }}">
                        {{ $product->price_10kg }}円
                    </td>
                    <td class="{{ $product->price_20kg == 0 ? 'text-danger fw-bold' : '' }}">
                        {{ $product->price_20kg }}円
                    </td>
                    <td class="{{ $product->price_30kg == 0 ? 'text-danger fw-bold' : '' }}">
                        {{ $product->price_30kg }}円
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}"
                        class="btn btn-sm btn-outline-primary">
                            編集
                        </a>

                        <form action="{{ route('products.destroy', $product) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('この商品を削除しますか？');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                削除
                            </button>
                        </form>
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
</div>

{{ $products->withQueryString()->links() }}

@endsection