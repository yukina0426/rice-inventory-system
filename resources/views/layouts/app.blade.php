<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>在庫管理システム</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header class="app-header">
    <div class="container">
        <h1 class="logo">🌾 在庫管理システム</h1>
    </div>
</header>

<main class="container py-4">
    @yield('content')
</main>

</body>
</html>