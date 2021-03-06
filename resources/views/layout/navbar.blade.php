@php
$semesters = \App\Models\Semester::orderByDesc('active_at')->get();
@endphp

<nav class="bg-white shadow" x-data="{ openMobileMenu: false }">
    <div class="mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex justify-end h-32 md:h-auto">
            <div class="absolute inset-y-0 left-0 flex items-center xl:hidden">
                <!-- Mobile menu button -->
                <button @click="show = true" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500"
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

            @auth
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <form action="{{ route('user.change-semester') }}" method="POST" id="change-semester-form"
                            class="mt-4">
                            @csrf
                            <div x-data="{ semesterId: '{{ Auth::user()->active_semester->id }}' }"
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
                                class="ml-auto bg-white rounded px-4 py-2 hover:bg-gray-100 font-medium flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
                                :class="{
                                    'btn': !open,
                                    'btn-secondary': open,
                                }"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                        </div>

                        <div @click.outside="open = false" x-cloak x-collapse x-show="open"
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
</nav>

@auth
    <aside class="container my-8 hidden md:block">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="bg-white rounded-md shadow px-6 flex space-x-4">
                <li class="flex">
                    <div class="flex items-center">
                        <a href="{{ route('index') }}" class="text-gray-500 hover:text-sky-400">
                            <!-- Heroicon name: solid/home -->
                            <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span class="sr-only">Home</span>
                        </a>
                    </div>
                </li>

                @php
                    $paths = Str::of(request()->path())
                        ->split('[/]')
                        ->filter(fn($e) => !empty($e))
                        ->map(fn($e) => Str::isUuid($e) ? $e : Str::replace('-', ' ', $e))
                        ->map(fn($e) => Str::isUuid($e) ? $e : Str::title($e));
                    $currentPath = '';
                @endphp

                @foreach ($paths as $path)
                    @php
                        $currentPath .= Str::kebab(Str::lower("/{$path}"));
                    @endphp

                    <li class="flex">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44"
                                preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                            </svg>
                            <a href="{{ $currentPath }}"
                                class="ml-4 text-sm font-medium @if ($loop->last) text-sky-500 @else text-gray-500 @endif hover:text-sky-400">
                                {{ $path }}
                            </a>
                        </div>
                    </li>
                @endforeach
            </ol>
        </nav>
    </aside>
@endauth
