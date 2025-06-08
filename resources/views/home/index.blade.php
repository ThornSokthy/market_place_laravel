<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env(".APP_NAME") }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <header class="bg-slate-800 text-white px-8 py-4">
        <div class="mb-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl">E-Market</h1>
            </div>
            <nav class="gap-6 font-semibold hidden md:flex">
                <a href="/" class="text-amber-600">HOME</a>
                <a>FEATURES</a>
                <a>SHOP</a>
                <a>BLOG</a>
                <a>PAGE</a>
                <a>MARKETPLACE</a>
            </nav>
            @guest
                <div class="flex justify-between items-center gap-1.5">
                    <i class='bx bx-lock-keyhole'></i>
                    <a href="{{ route('login') }}">Login</a>
                    <span>or</span>
                    <a href="{{ route('register') }}">Register</a>
                </div>
            @endguest
            @auth
                <div class="flex items-center" x-data="{ open: false }" @click.away="open = false">
                    <div class="relative flex items-center">
                        <div
                            class="group relative flex items-center justify-center w-10 h-10 rounded-full overflow-hidden border-2 border-gray-200 cursor-pointer hover:border-blue-500 transition-colors duration-200"
                            @click="open = !open"
                        >
                            <img
                                class="w-full h-full object-cover transition-transform duration-200 hover:scale-105"
                                src="{{ Auth::user()->profile_photo_url ?? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) }}"
                                alt="Profile picture"
                            />
                        </div>

                        <span
                            class="text-2xl ml-1 cursor-pointer hover:text-blue-500 transition-colors duration-200"
                            @click="open = !open"
                        >
                            <i class='bx bx-chevron-down'></i>
                        </span>

                        <div
                            class="absolute top-12 right-0 mt-1 w-48 bg-white rounded-md shadow-lg py-1 z-50 transition-all duration-200 ease-out origin-top-right"
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            style="display: none"
                        >
                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100/90 hover:text-blue-600 transition-all duration-200 ease-in-out"
                            >
                                <i class='bx bx-user mr-2'></i>My Profile
                            </a>
                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100/90 hover:text-blue-600 transition-all duration-200 ease-in-out"
                            >
                                <i class='bx bx-cog mr-2'></i>Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="block text-start w-full cursor-pointer px-4 py-2 text-sm text-red-600 hover:bg-red-100/90 hover:text-red-700 transition-all duration-200 ease-in-out"
                                >
                                    <i class='bx  bx-arrow-out-left-square-half mr-2' ></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
        <div class="flex justify-between items-center">
            <div>
                <button class="flex items-center gap-1 py-2 px-4 rounded-sm cursor-pointer bg-amber-600">
                    <span class="text-xl"><i class='bx bx-menu-wide'></i></span>
                    <span class="hidden md:block">ALL CATEGORIES</span>
                    <span class="text-2xl ml-6 hidden md:block"><i class='bx bx-chevron-down'  ></i> </span>
                </button>
            </div>
            <div class="w-2/3 flex justify-center">
                <input class="w-2/3 bg-white text-black focus:outline-0 py-2 pl-3 rounded-tl-sm rounded-bl-sm" type="text" placeholder="Search...."/>
                <button class="bg-amber-600 text-xl px-6 py-2.5 rounded-tr-sm rounded-br-sm">
                    <i class='bx bx-search'></i>
                </button>
            </div>
            <span class="flex justify-between gap-4">
                <span class="text-3xl"><i class='bx bx-heart'></i> </span>
                <span class="text-3xl"><i class='bx bx-cart'></i> </span>
            </span>
        </div>
    </header>

</body>
</html>
