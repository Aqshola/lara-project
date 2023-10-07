<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple Product Order</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite('resources/css/app.css')
</head>

<nav class="w-full bg-blue-200 max-w-screen-2xl mx-auto p-3 flex justify-between">
    <h1 class="font-semibold">Simple Product </h1>
    <div class="flex gap-2">
        <a href="{{ route('product.index') }}" class="underline">Product</a>
        <a href="{{ route('patient.index') }}" class="underline">Patient</a>
        <a href="{{ route('invoice.index') }}" class="underline">Invoice</a>
    </div>

</nav>

<body class="antialiased">
    <div class="max-w-screen-2xl mx-auto min-h-screen flex flex-col p-10">
        @yield('content')
    </div>
</body>

</html>

@yield('scripts')
