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

<body class="min-h-full overflow-x-hidden">
    <div class="relative flex min-h-full" x-data="{ show: false }">
        @auth
            <div class="sticky top-0 left-0 hidden h-screen p-4 bg-blue-100 xl:block">
                <h1 class="font-bold mb-4 text-lg">Bee Portal</h1>
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($menus as $menu)
                        <a href="{{ route($menu->role . '.' . $menu->route_name) }}"
                            class="{{ request()->is("*$menu->route_name*") ? 'border-l-4 border-blue-500 bg-blue-300 hover:bg-blue-400' : 'bg-blue-200 hover:bg-blue-300' }} px-4 py-2 rounded">
                            {{ $menu->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div x-cloak x-show="show" class="fixed z-10 w-full h-full bg-black bg-opacity-50" @click.self="show = false">
                <div x-cloak x-transition x-show="show" class="h-full p-4 origin-top-left bg-blue-100" style="width: 25%;">
                    <h1 class="mb-6 text-xl font-bold">Bee Portal</h1>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($menus as $menu)
                            <a href="{{ route($menu->role . '.' . $menu->route_name) }}"
                                class="{{ request()->is("*$menu->route_name*") ? 'border-l-4 border-blue-500 bg-blue-300 hover:bg-blue-400' : 'bg-blue-200 hover:bg-blue-300' }} px-4 py-2 rounded">
                                {{ $menu->name }}
                            </a>
                        @endforeach
                    </div>
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
