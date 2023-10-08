<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple Product Order</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="max-w-screen-2xl mx-auto bg-slate-100 min-h-screen flex justify-center items-center flex-col">
        <h1 class="text-4xl font-bold">Simple Dashboard Product Web</h1>
        <div class="flex gap-2 justify-center mt-5 text-lg">
            <a href="/product">Product</a>
            <a href="/patient">Patient</a>
            <a href="/invoice">Patient</a>
        </div>
    </div>
</body>

</html>
