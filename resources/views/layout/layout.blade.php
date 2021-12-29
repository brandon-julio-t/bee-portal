<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Bee Portal</title>
    <script defer src="https://unpkg.com/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-full overflow-x-hidden">
    <div class="relative flex min-h-full" x-data="{ show: false }">
        @includeWhen(Auth::check(), 'layout.sidebar')
        <div class="flex-1">
            @include('layout.navbar')
            @include('components.alert-errors')
            @include('components.alert-success')

            <main class="my-8">
                @yield('body')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
