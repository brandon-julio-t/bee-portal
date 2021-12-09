@php
$menus = [];
$semesters = [];

if (Auth::check()) {
    $user = Auth::user();
    $menus = \App\Models\Menu::where('role', $user->role)
        ->orWhere('role', 'all')
        ->orderBy('name')
        ->get();
    $semesters = \App\Models\Semester::orderByDesc('active_at')->get();
}
@endphp

<nav class="bg-white shadow" x-data="{ openMobileMenu: false }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex justify-between h-32 md:h-auto">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button -->
                <button @click="openMobileMenu = !openMobileMenu" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!--
                        Icon when menu is closed.

                        Heroicon name: outline/menu

                        Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!--
                        Icon when menu is open.

                        Heroicon name: outline/x

                        Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
                    @auth
                        <a href="{{ route('home') }}"
                            class="{{ request()->is('home') ? 'border-indigo-500 text-gray-900 inline-flex items-end pb-2 px-1 pt-1 border-b-2 text-sm font-medium' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-end pb-2 px-1 pt-1 border-b-2 text-sm font-medium' }}">
                            Home
                        </a>
                    @endauth
                    @foreach ($menus as $menu)
                        <a href="{{ route($menu->role . '.' . $menu->route_name) }}"
                            class="{{ request()->is("*$menu->route_name*") ? 'border-indigo-500 text-gray-900 inline-flex items-end pb-2 px-1 pt-1 border-b-2 text-sm font-medium' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-end pb-2 px-1 pt-1 border-b-2 text-sm font-medium' }}">
                            {{ $menu->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            @auth
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <form action="{{ route('user.change-semester') }}" method="POST" id="change-semester-form"
                            class="mt-4">
                            @csrf
                            <div x-data="{ semesterId: '{{ Auth::user()->activeSemester() }}' }"
                                x-init="$watch('semesterId', () => { document.querySelector('#change-semester-form').submit() })">
                                <select name="semester_id" class="form-input" x-model="semesterId">
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester->id }}">
                                            {{ $semester->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <div class="my-2">
                            <button @click="open = !open" type="button"
                                class="ml-auto bg-white rounded px-4 py-2 hover:bg-gray-100 font-medium flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                        </div>

                        <div x-cloak x-transition x-show="open"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <form action="{{ route('auth.logout') }}" method="POST" class=w-full>
                                @csrf
                                <button type="submit"
                                    class="block px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-200 w-full"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 my-4">
                    <a href="{{ route('auth.login.view') }}" class="btn-secondary">Login</a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-cloak x-transition x-show="openMobileMenu" id="mobile-menu">
        <div class="pt-2 pb-4 space-y-1">
            <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" -->
            @auth
                <a href="{{ route('home') }}"
                    class="{{ request()->is('home') ? 'bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium' }}">
                    Home
                </a>
            @endauth
            @foreach ($menus as $menu)
                <a href="{{ route($menu->role . '.' . $menu->route_name) }}"
                    class="{{ request()->is("*$menu->route_name*") ? 'bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium' }}">
                    {{ $menu->name }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
