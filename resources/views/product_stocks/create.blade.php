@extends('layouts.admin')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title">年度在庫登録</h2>
</div>

<div class="card">
    <div class="card-body">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('product-stocks.store') }}" method="POST">
            @csrf

            <!-- 品種 -->
            <div class="mb-3">
                <label class="form-label">品種</label>

                <select name="product_id" class="form-select">
                    <option value="">選択してください</option>

                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->variety }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- 年産 -->
            <div class="mb-3">
                <label class="form-label">年産</label>
                <input
                    type="number"
                    name="crop_year"
                    class="form-control"
                    placeholder="2026">
            </div>

            <!-- 在庫 -->

            <div class="row">

                <div class="col-md-3">
                    <label class="form-label">5kg在庫</label>
                    <input type="number" name="stock_5kg" class="form-control" value="0">
                </div>

                <div class="col-md-3">
                    <label class="form-label">10kg在庫</label>
                    <input type="number" name="stock_10kg" class="form-control" value="0">
                </div>

                <div class="col-md-3">
                    <label class="form-label">20kg在庫</label>
                    <input type="number" name="stock_20kg" class="form-control" value="0">
                </div>

                <div class="col-md-3">
                    <label class="form-label">30kg在庫</label>
                    <input type="number" name="stock_30kg" class="form-control" value="0">
                </div>

            </div>

            <div class="d-flex justify-content-center gap-2 mt-4">
            <button type="submit" class="btn btn-primary">
                登録
            </button>

            <a href="{{ route('product-stocks.index') }}" class="btn btn-outline-secondary">
                一覧に戻る
            </a>
        </div>

        </form>

    </div>
</div>

@endsection