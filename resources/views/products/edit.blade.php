@extends('layouts.app')

@section('content')

<h2>お米在庫編集</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')

    <table class="table table-bordered align-middle">
        <tr>
            <th style="width: 180px;">品種</th>
            <td>
                <input type="text" name="variety" value="{{ old('variety', $product->variety) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>5kg在庫</th>
            <td>
                <input type="number" name="stock_5kg" value="{{ old('stock_5kg', $product->stock_5kg) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>10kg在庫</th>
            <td>
                <input type="number" name="stock_10kg" value="{{ old('stock_10kg', $product->stock_10kg) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>20kg在庫</th>
            <td>
                <input type="number" name="stock_20kg" value="{{ old('stock_20kg', $product->stock_20kg) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>30kg在庫</th>
            <td>
                <input type="number" name="stock_30kg" value="{{ old('stock_30kg', $product->stock_30kg) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>5kg価格</th>
            <td>
                <input type="number" name="price_5kg" value="{{ old('price_5kg', $product->price_5kg) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>10kg価格</th>
            <td>
                <input type="number" name="price_10kg" value="{{ old('price_10kg', $product->price_10kg) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>20kg価格</th>
            <td>
                <input type="number" name="price_20kg" value="{{ old('price_20kg', $product->price_20kg) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>30kg価格</th>
            <td>
                <input type="number" name="price_30kg" value="{{ old('price_30kg', $product->price_30kg) }}" class="form-control">
            </td>
        </tr>

        <tr>
            <th>説明</th>
            <td>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
            </td>
        </tr>
    </table>

    <button type="submit" class="btn btn-primary">
        更新
    </button>

    <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">
        詳細へ戻る
    </a>

    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
        一覧へ戻る
    </a>
</form>

@endsection