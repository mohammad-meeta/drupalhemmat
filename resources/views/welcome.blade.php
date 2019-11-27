<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Welcome page</h1>
    </div>

    <script defer src="{{ mix('js/app.js') }}"></script>
    <script defer src="{{ mix('js/pages/welcome/index.js') }}"></script>
</body>
</html>
