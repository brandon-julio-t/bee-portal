<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Bee Portal</title>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>

    @include('layout.navbar')
    @include('components.alert-errors')
    @include('components.alert-success')

    <main class="my-8">
        @yield('body')
    </main>

</body>

</html>
