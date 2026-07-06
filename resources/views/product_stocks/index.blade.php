@extends('layouts.admin')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title">年度在庫一覧</h2>

    <a href="{{ route('product-stocks.create') }}" class="btn btn-primary">
        年度在庫登録
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="search-card">
    <form action="{{ route('product-stocks.index') }}" method="GET" class="row g-2">
        <div class="col-md-5">
            <input
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
                class="form-control"
                placeholder="品種名で検索"
            >
        </div>

        <div class="col-md-3">
            <input
                type="number"
                name="crop_year"
                value="{{ request('crop_year') }}"
                class="form-control"
                placeholder="年産 例：2026"
            >
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-secondary">
                検索
            </button>
        </div>

        <div class="col-auto">
            <a href="{{ route('product-stocks.index') }}" class="btn btn-outline-secondary">
                クリア
            </a>
        </div>
    </form>
</div>

<div class="table-card">
    <p class="text-muted">
        全{{ $stocks->total() }}件
    </p>

    <table class="table inventory-table align-middle">
        <thead class="table-light">
            <tr>
                <th>品種</th>
                <th>年産</th>
                <th>5kg</th>
                <th>10kg</th>
                <th>20kg</th>
                <th>30kg</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse ($stocks as $stock)
                <tr>
                    <td>{{ $stock->product->variety }}</td>
                    <td>{{ $stock->crop_year }}年産</td>

                    <td class="{{ $stock->stock_5kg == 0 ? 'text-danger fw-bold' : '' }}">
                        {{ $stock->stock_5kg }}袋
                    </td>

                    <td class="{{ $stock->stock_10kg == 0 ? 'text-danger fw-bold' : '' }}">
                        {{ $stock->stock_10kg }}袋
                    </td>

                    <td class="{{ $stock->stock_20kg == 0 ? 'text-danger fw-bold' : '' }}">
                        {{ $stock->stock_20kg }}袋
                    </td>

                    <td class="{{ $stock->stock_30kg == 0 ? 'text-danger fw-bold' : '' }}">
                        {{ $stock->stock_30kg }}袋
                    </td>

                    <td>
                        <a href="{{ route('product-stocks.edit', $stock) }}" class="btn btn-sm btn-outline-primary">
                            編集
                        </a>

                        <form action="{{ route('product-stocks.destroy', $stock) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('この年度在庫を削除しますか？');">
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
                    <td colspan="7" class="text-center">
                        該当する年度在庫がありません。
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $stocks->withQueryString()->links() }}

@endsection