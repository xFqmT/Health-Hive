<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKS Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Link to your CSS file -->
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Link to your JS file -->
</body>
</html>
