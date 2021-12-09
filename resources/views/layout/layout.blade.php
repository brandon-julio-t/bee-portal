@php
$menus = [];

if (Auth::check()) {
    $user = Auth::user();
    $menus = \App\Models\Menu::where('role', $user->role)
        ->orWhere('role', 'all')
        ->orderBy('name')
        ->get();
}
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Bee Portal</title>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-full">
    <div class="flex min-h-full relative">
        @auth
            <div class="p-4 h-screen bg-blue-100 top-0 left-0 hidden lg:block sticky">
                <h1 class="font-bold mb-8">Bee Portal</h1>
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($menus as $menu)
                        <a href="{{ route($menu->role . '.' . $menu->route_name) }}"
                            class="{{ request()->is("*$menu->route_name*") ? 'border-l-4 border-blue-500 bg-blue-300 hover:bg-blue-400' : 'bg-blue-200 hover:bg-blue-300' }} px-4 py-2 rounded">
                            {{ $menu->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endauth
        <div class="flex-1">
            @include('layout.navbar')
            @include('components.alert-errors')
            @include('components.alert-success')

            <main class="my-8">
                @yield('body')
            </main>
        </div>
    </div>
</body>

</html>
