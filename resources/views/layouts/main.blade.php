<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Product</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
            rel="stylesheet"
        />

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img
                id="background"
                class="absolute -left-20 top-0 max-w-[877px]"
                src="https://laravel.com/assets/img/welcome/background.svg"
            />
            <div
                class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white"
            >
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid items-center gap-2 py-4">
                        <div
                            class="container mx-auto py-4 flex items-center justify-between"
                        >
                            <a
                                href="{{ route('home') }}"
                                class="text-gray-800 font-bold"
                            >
                                {{ config("app.name") }}
                            </a>

                            <nav class="hidden md:block">
                                <ul class="flex justify-between">
                                    <li class="mx-2">
                                        <a
                                            href="{{ route('home') }}"
                                            class="text-gray-800 hover:text-gray-600"
                                            >Home</a
                                        >
                                    </li>
                                    <li class="mx-2">
                                        <a
                                            href="{{ route('products') }}"
                                            class="text-gray-800 hover:text-gray-600"
                                            >Product</a
                                        >
                                    </li>
                                    <li class="mx-2">
                                        <a
                                            href="{{ route('suppliers') }}"
                                            class="text-gray-800 hover:text-gray-600"
                                            >Supplier</a
                                        >
                                    </li>
                                    <li class="mx-2">
                                        <a
                                            href="{{ route('orders') }}"
                                            class="text-gray-800 hover:text-gray-600"
                                            >Order</a
                                        >
                                    </li>
                                    <li class="mx-2">
                                        <a
                                            href="{{ route('users') }}"
                                            class="text-gray-800 hover:text-gray-600"
                                            >User</a
                                        >
                                    </li>
                                </ul>
                            </nav>

                            @auth
                            <div class="flex items-center">
                                <div class="dropdown relative">
                                    <button
                                        class="text-gray-800 font-bold hover:text-gray-600 dropdown-toggle"
                                        data-dropdown-toggle="dropdown-menu"
                                        aria-expanded="false"
                                    >
                                        {{ Auth::user()->name }}
                                    </button>

                                    <ul
                                        class="dropdown-menu hidden absolute top-full right-0 bg-white shadow mt-2"
                                        data-dropdown-menu
                                    >
                                        <li>
                                            <a
                                                href="{{ route('profile') }}"
                                                class="text-gray-800 hover:text-gray-600"
                                                >Profile</a
                                            >
                                        </li>
                                        <li>
                                            <a
                                                href="{{ route('logout') }}"
                                                class="text-gray-800 hover:text-gray-600"
                                                >Logout</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endauth
                        </div>

                        @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                            @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </a>
                            @endif @endauth
                        </nav>
                        @endif
                    </header>

                    <main>@yield('content')</main>

                    <footer
                        class="py-16 text-center text-sm text-black dark:text-white/70"
                    >
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                        (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
