<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>在庫管理システム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
</head>
<body>
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">

            <h1 class="header-title">在庫管理システム</h1>

            <div class="d-flex align-items-center gap-3">
                <div class="text-white">
                    {{ Auth::user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        ログアウト
                    </button>
                </form>
            </div>

        </div>
        <nav class="header-nav">
            <div class="container">

                <a href="{{ route('products.index') }}">商品一覧</a>

                <a href="{{ route('product-stocks.index') }}">年度在庫一覧</a>

                {{-- 後で追加 --}}
                {{-- <a href="{{ route('sales.index') }}">販売履歴</a> --}}

            </div>
        </nav>
    </header>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>