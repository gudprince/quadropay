<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="app ">

    <main class=""  id="app">
        {{$slot}}
    </main>
</body>
</html>