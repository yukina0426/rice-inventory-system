@extends('layouts.admin')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title">お米在庫編集</h2>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="table-card">
    <form action="{{ route('product-stocks.update', $productStock) }}" method="POST">
        @csrf
        @method('PUT')

        <table class="table detail-table align-middle">
            <tr>
                <th style="width: 180px;">品種</th>
                <td>
                    <select name="product_id" class="form-select">

                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ old('product_id', $productStock->product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->variety }}
                            </option>
                        @endforeach

                    </select>
                </td>
            </tr>

            <tr>
                <th>年産</th>
                <td>
                    <input type="number" name="crop_year" value="{{ old('crop_year', $productStock->crop_year) }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>5kg在庫</th>
                <td>
                    <input type="number" name="stock_5kg" value="{{ old('stock_5kg', $productStock->stock_5kg) }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>10kg在庫</th>
                <td>
                    <input type="number" name="stock_10kg" value="{{ old('stock_10kg', $productStock->stock_10kg) }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>20kg在庫</th>
                <td>
                    <input type="number" name="stock_20kg" value="{{ old('stock_20kg', $productStock->stock_20kg) }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>30kg在庫</th>
                <td>
                    <input type="number" name="stock_30kg" value="{{ old('stock_30kg', $productStock->stock_30kg) }}" class="form-control">
                </td>
            </tr>

        </table>

        <button type="submit" class="btn btn-primary">
            更新
        </button>

        <a href="{{ route('product-stocks.index') }}" class="btn btn-outline-secondary">
            年度在庫一覧へ戻る
        </a>
    </form>

@endsection