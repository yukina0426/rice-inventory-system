@extends('layouts.admin')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title">販売登録</h2>
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
    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <table class="table form-table align-middle">
            <tr>
                <th style="width: 180px;">商品・年度</th>
                <td>
                    <select name="product_stock_id" id="product_stock_id" class="form-select">
                        <option value="">選択してください</option>
                        @foreach ($productStocks as $productStock)
                            <option value="{{ $productStock->id }}" {{ old('product_stock_id') == $productStock->id ? 'selected' : '' }}>
                                {{ $productStock->product->variety }} / {{ $productStock->crop_year }}年産
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <th>販売日</th>
                <td>
                    <input type="date" name="sale_date" class="form-control"
                           value="{{ old('sale_date', date('Y-m-d')) }}">
                </td>
            </tr>

            <tr>
                <th>顧客名</th>
                <td>
                    <input type="text" name="customer_name" class="form-control"
                           value="{{ old('customer_name') }}">
                </td>
            </tr>

            <tr>
                <th>サイズ</th>
                <td>
                    <select name="size" class="form-select">
                        <option value="">選択してください</option>
                        <option value="5" {{ old('size') == 5 ? 'selected' : '' }}>5kg</option>
                        <option value="10" {{ old('size') == 10 ? 'selected' : '' }}>10kg</option>
                        <option value="20" {{ old('size') == 20 ? 'selected' : '' }}>20kg</option>
                        <option value="30" {{ old('size') == 30 ? 'selected' : '' }}>30kg</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>販売数量</th>
                <td>
                    <input type="number" name="quantity" class="form-control"
                           value="{{ old('quantity') }}" min="1">
                </td>
            </tr>

            <tr>
                <th>販売方法</th>
                <td>
                    <select name="sale_method" class="form-select">
                        <option value="">選択してください</option>
                        <option value="引取" {{ old('sale_method') == '引取' ? 'selected' : '' }}>引取</option>
                        <option value="配達" {{ old('sale_method') == '配達' ? 'selected' : '' }}>配達</option>
                        <option value="発送" {{ old('sale_method') == '発送' ? 'selected' : '' }}>発送</option>
                        <option value="その他" {{ old('sale_method') == 'その他' ? 'selected' : '' }}>その他</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>備考</th>
                <td>
                    <textarea name="note" class="form-control" rows="4">{{ old('note') }}</textarea>
                </td>
            </tr>
        </table>

        <div class="d-flex justify-content-center gap-2 mt-4">
            <button type="submit" class="btn btn-primary">
                登録
            </button>

            <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
                販売履歴へ戻る
            </a>
        </div>
    </form>
</div>

@endsection