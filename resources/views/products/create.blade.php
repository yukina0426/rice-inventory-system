@extends('layouts.app')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title">お米在庫登録</h2>
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
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <table class="table form-table align-middle">
            <tr>
                <th style="width: 180px;">品種</th>
                <td>
                    <input type="text" name="variety" value="{{ old('variety') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>5kg在庫</th>
                <td>
                    <input type="number" name="stock_5kg" value="{{ old('stock_5kg') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>10kg在庫</th>
                <td>
                    <input type="number" name="stock_10kg" value="{{ old('stock_10kg') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>20kg在庫</th>
                <td>
                    <input type="number" name="stock_20kg" value="{{ old('stock_20kg') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>30kg在庫</th>
                <td>
                    <input type="number" name="stock_30kg" value="{{ old('stock_30kg') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>5kg価格</th>
                <td>
                    <input type="number" name="price_5kg" value="{{ old('price_5kg') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>10kg価格</th>
                <td>
                    <input type="number" name="price_10kg" value="{{ old('price_10kg') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>20kg価格</th>
                <td>
                    <input type="number" name="price_20kg" value="{{ old('price_20kg') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>30kg価格</th>
                <td>
                    <input type="number" name="price_30kg" value="{{ old('price_30kg') }}" class="form-control">
                </td>
            </tr>

            <tr>
                <th>説明</th>
                <td>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </td>
            </tr>
        </table>

        <div class="d-flex justify-content-center gap-2 mt-4">
            <button type="submit" class="btn btn-primary">
                登録
            </button>

            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                一覧に戻る
            </a>
</div>
    </form>
</div>

@endsection