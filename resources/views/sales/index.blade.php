@extends('layouts.admin')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title">販売履歴一覧</h2>

    <a href="{{ route('sales.create') }}" class="btn btn-primary">
        販売登録
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    <div class="col-md-3">
        <div class="table-card">
            <h5 class="mb-3">検索条件</h5>

            <form action="{{ route('sales.index') }}" method="GET">
                <div class="mb-3">
                    <label class="form-label">販売日</label>
                    <input type="date" name="sale_date" value="{{ request('sale_date') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">顧客名</label>
                    <input type="text" name="customer_name" value="{{ request('customer_name') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">品種</label>
                    <input type="text" name="variety" value="{{ request('variety') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">年産</label>
                    <input type="number" name="crop_year" value="{{ request('crop_year') }}" class="form-control">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-secondary">
                        検索
                    </button>

                    <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
                        クリア
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-9">
        <div class="table-card">
            <p class="text-muted">
                全{{ $sales->total() }}件
            </p>

            @if($hasSearch)
                <p class="fw-bold">
                    検索結果の合計金額：{{ number_format($totalAmount) }}円
                </p>
            @endif

            <div class="table-responsive">
                <table class="table inventory-table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>販売日</th>
                            <th>顧客名</th>
                            <th>品種</th>
                            <th>年度</th>
                            <th>サイズ</th>
                            <th>数量</th>
                            <th>単価</th>
                            <th>合計金額</th>
                            <th>販売方法</th>
                            <th>備考</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $sale->sale_date }}</td>
                                <td>{{ $sale->customer_name ?? '-' }}</td>
                                <td>{{ $sale->productStock->product->variety }}</td>
                                <td>{{ $sale->productStock->crop_year }}年産</td>
                                <td>{{ $sale->size }}kg</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ number_format($sale->unit_price) }}円</td>
                                <td class="fw-bold">{{ number_format($sale->total_price) }}円</td>
                                <td>{{ $sale->sale_method }}</td>
                                <td class="description-column">{{ $sale->note }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">
                                    販売履歴がありません。
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $sales->withQueryString()->links() }}
    </div>
</div>

@endsection