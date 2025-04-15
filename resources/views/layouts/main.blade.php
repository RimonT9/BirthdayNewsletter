<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>SPA App</title>
</head>
<body>
    <div id='app' class='p-5'>
        @yield('content')
    </div>
</body>
</html>