@php
$menus = [];

if (Auth::check()) {
    $user = Auth::user();
    $q = \App\Models\Menu::where('role', $user->role);

    if (!$user->isAdmin()) {
        $q = $q->orWhere('role', 'general');
    }

    $menus = $q->orderBy('name')->get();
}
@endphp

<div class="sticky top-0 left-0 hidden h-screen p-4 bg-sky-100 xl:block w-full" style="max-width: 200px;">
    <h1 class="font-bold mb-4 text-lg">Bee Portal</h1>
    <div class="grid grid-cols-1 gap-4">
        @foreach ($menus as $menu)
            <a href="{{ route($menu->role . '.' . $menu->route_name) }}"
                class="{{ request()->is("*$menu->route_name*") ? 'border-l-4 border-sky-500 bg-sky-300 hover:bg-sky-400 font-bold' : 'bg-sky-200 hover:bg-sky-300' }} px-4 py-2 rounded">
                {{ $menu->name }}
            </a>
        @endforeach
    </div>
</div>
<div x-cloak x-show="show" class="fixed z-10 w-full h-full bg-black bg-opacity-50" @click.self="show = false">
    <div x-cloak x-transition x-show="show" class="h-full p-4 origin-top-left bg-sky-100" style="width: 25%;">
        <h1 class="mb-6 text-xl font-bold">Bee Portal</h1>
        <div class="grid grid-cols-1 gap-4">
            @foreach ($menus as $menu)
                <a href="{{ route($menu->role . '.' . $menu->route_name) }}"
                    class="{{ request()->is("*$menu->route_name*") ? 'border-l-4 border-sky-500 bg-sky-300 hover:bg-sky-400 font-bold' : 'bg-sky-200 hover:bg-sky-300' }} px-4 py-2 rounded">
                    {{ $menu->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>
