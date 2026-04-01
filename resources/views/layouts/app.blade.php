<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            background: #f4f6f9;
        }

        .wrapper {
            display: flex;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #fff;
            padding: 25px;
            position: fixed;
            box-shadow: 2px 0 8px rgba(0,0,0,0.05);
        }

        .main {
            margin-left: 260px;
            width: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 12px;
            text-decoration: none;
            color: #333;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .menu-item i {
            margin-right: 10px;
        }

        .menu-item:hover {
            background: #e9f2ff;
            color: #0d6efd;
        }

        .menu-item.active {
            background: #dbeafe;
            color: #0d6efd;
        }

        .badge-role {
            background: #dbeafe;
            color: #0d6efd;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        .header {
            height: 70px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .footer {
            background: #fff;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="wrapper">

    @include('layouts.sidebar')

    <div class="main">
        @include('layouts.header')

        <div class="content">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

</div>

@yield('scripts')

</body>
</html>
