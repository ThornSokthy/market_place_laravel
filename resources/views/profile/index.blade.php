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
    <div class=" flex justify-between items-center">
        <div>
            <a href="{{ route('home') }}" class="text-2xl">E-Market</a>
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
                            href="{{ route('profile') }}"
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
</header>

    <div class="w-full max-w-full mx-auto bg-white shadow-sm overflow-hidden">

        <div class="h-40 bg-gradient-to-r from-blue-500 to-purple-600 relative">
            <img src="https://images.pexels.com/photos/378570/pexels-photo-378570.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                 class="w-full h-full object-cover" alt="Cover photo">
        </div>

        <div class="px-4 sm:px-16 md:px-20 lg:px-28 pb-4 relative border-b-1 border-double border-gray-400">

            <div class="absolute -top-12 left-2 sm:left-10 md:left-16 lg:left-24 border-4 border-white rounded-full overflow-hidden">
                <img src="https://randomuser.me/api/portraits/men/1.jpg"
                     alt="Profile"
                     class="w-24 h-24 object-cover">
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center">

                <div class="w-full pt-2 pl-28 sm:pl-36 md:pl-24">
                    <h1 class="text-lg font-semibold">John Doe</h1>
                    <p class="text-sm text-gray-500">Member since August 2017</p>
                </div>

                <div class="flex justify-between md:justify-end items-center w-full gap-6 mt-4 border-gray-100 pt-3">
                    <button class="bg-amber-500 px-5 py-2.5 rounded-md text-sm font-medium cursor-pointer text-white hover:bg-amber-600 transition-colors">
                        Add Post
                    </button>
                    <div class="flex gap-6">
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Events</p>
                            <p class="font-semibold">22</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Posts</p>
                            <p class="font-semibold">40</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center pt-3 px-4 sm:px-16 md:px-20 lg:px-28">
                <div class="text-xl md:text-2xl font-semibold text-gray-800 ">
                    My items
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-semibold text-gray-700">Sort by: </span>
                    <span class="text-sm font-semibold">Newest first</span>
                    <span class="text-2xl"><i class='bx bx-chevron-down'  ></i></span>
                </div>
            </div>

            <div class="my-6 px-4 sm:px-16 md:px-20 lg:px-28 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">

                @foreach([1,2,3,4,5] as $test)

                    <div class="flex flex-col shadow-lg p-2 h-full relative" x-data="{ open: false }">
                        <div class="w-full aspect-square rounded-sm overflow-hidden mb-2 relative">
                            <img class="w-full h-full object-cover"
                                 src="https://d2v5dzhdg4zhx3.cloudfront.net/web-assets/images/storypages/primary/ProductShowcasesampleimages/JPEG/Product+Showcase-1.jpg"
                                 alt="Nike shoe" />

                            <div class="absolute top-0 right-2">
                                <span class="text-2xl py-1 cursor-pointer rounded-full w-8 h-8 flex items-center justify-center text-gray-100/90  transition-all"
                                      @click="open = !open"
                                      @click.outside="open = false">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col flex-grow px-2 pb-1.5">
                            <p class="my-1 line-clamp-2">Nike shoe</p>
                            <p class="text-sm text-gray-500">2h ago by <span class="text-cyan-500">Thy Smos</span></p>
                            <div class="flex justify-between items-end mt-4">
                                <span>$90.00</span>
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm">
                                    View Detail
                                </button>
                            </div>
                        </div>

                        <div class="absolute top-8 -right-8 mt-1 w-32 bg-white rounded-md shadow-lg py-1 z-50 transition-all duration-200 ease-out origin-top-right"
                             x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             style="display: none">
                            <a href="#"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100/90 hover:text-blue-600 transition-all duration-200 ease-in-out">
                                <i class='bx bx-edit mr-2'></i>Edit
                            </a>
                            <a href="#"
                               class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100/90 hover:text-red-700 transition-all duration-200 ease-in-out">
                                <i class='bx bx-trash mr-2'></i>Delete
                            </a>
                        </div>
                    </div>

                @endforeach

            </div>

        </div>
    </div>



<footer class="mt-4 bg-slate-800 text-white py-8 px-4">
    <div class="container mx-auto max-w-6xl">
        <div class="flex flex-col md:flex-row justify-between mb-8">
            <div class="mb-6 md:mb-0">
                <div class="flex flex-col mb-4">
                    <span class="text-xl font-bold mr-4">E-Market</span>
                    <span class="text-sm">Your Toggle here</span>
                </div>
                <p class="max-w-xs mb-4">
                    We want to help bring talented students and unique start-ups together.
                </p>
                <div class="mb-2">
                    <span class="font-semibold text-amber-500">Contact Us:</span>
                </div>
                <div class="mb-1">
                    <i class='bx  bx-phone'  ></i>
                    <span>+91 9999 999 999</span>
                </div>
                <div>
                    <i class='bx  bx-envelope-open' ></i>
                    <span>youremail@com</span>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4 text-amber-500">Information</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-gray-900">About Us</a></li>
                        <li><a href="#" class="hover:text-gray-900">More Search</a></li>
                        <li><a href="#" class="hover:text-gray-900">Blog</a></li>
                        <li><a href="#" class="hover:text-gray-900">Testimonials</a></li>
                        <li><a href="#" class="hover:text-gray-900">Events</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4 text-amber-500">Helpful Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-gray-900">Services</a></li>
                        <li><a href="#" class="hover:text-gray-900">Supports</a></li>
                        <li><a href="#" class="hover:text-gray-900">Terms & Condition</a></li>
                        <li><a href="#" class="hover:text-gray-900">Privacy Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4 text-amber-500">Subscribe More Info</h3>
                    <div class="mb-4">
                        <input type="email" placeholder="Enter your Email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-400">
                    </div>
                    <div class="text-sm font-semibold rounded-sm cursor-pointer w-fit bg-amber-500 py-2 px-4">Subscribe</div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-300 pt-6 text-center">
            <p>2018 © companyList All Right reserved</p>
        </div>
    </div>
</footer>

</body>
</html>

