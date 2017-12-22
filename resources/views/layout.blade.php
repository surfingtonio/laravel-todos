<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Todos</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    @yield('content')
    <script src="js/app.js"></script>
</body>
</html>