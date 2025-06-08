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
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden border-2 border-gray-200">
                        <img
                            class="w-full h-full object-cover"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiZX50lN9UDKJALw9W8Lzes53T9GX8aKHIh15WJn4QBXx7ZjmAjsS5Yds&s"
                            alt="Profile picture"
                        />
                    </div>
                    <span class="text-2xl ml-1"><i class='bx bx-chevron-down'  ></i> </span>
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
            </div>
        </div>
    </header>

</body>
</html>
