<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env(".APP_NAME") }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; 
        }
    </style>
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
    <div class="p-4 md:p-8 lg:p-12">
        <div class="container mx-auto max-w-7xl">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-3/4 bg-white rounded-xl shadow-md p-6">
                    <div class="grid grid-cols-12 gap-1 text-lg text-white bg-amber-600 rounded-lg p-4 mb-4">
                        <div class="col-span-1"></div> 
                        <div class="col-span-5 md:col-span-4">Product</div>
                        <div class="col-span-2 md:col-span-2 text-center md:text-left">Price</div>
                        <div class="col-span-2 md:col-span-3 text-center">Quantity</div>
                        <div class="col-span-2 md:col-span-2 text-right">Connetion</div>
                    </div>

                    <div class="grid grid-cols-12 items-center gap-4 py-4 border-b border-gray-200">
                        <div class="col-span-1 ">
                            
                        </div>
                        <div class="col-span-5 md:col-span-4 flex items-center gap-3">
                            <img src="https://placehold.jp/150x150.png" class="w-14 h-14 rounded-lg object-cover shadow-sm">
                            <div>
                                <p class="font-medium text-black">T-Shirt</p>
                            </div>
                        </div>
                        <div class="col-span-2 md:col-span-2 text-center md:text-left font-bold text-black ">$1.00</div>
                        <div class="col-span-2 md:col-span-3 flex items-center justify-center space-x-1">
                            <span class="font-bold">1</span>
                        </div>
                        <button class="col-span-2 md:col-span-2 text-center text-white bg-amber-600 text-white py-1 px-2 rounded-md hover:bg-amber-500">Click me</button>
                    </div>

                    <div class="grid grid-cols-12 items-center gap-4 py-4 border-b border-gray-200">
                        <div class="col-span-1 flex justify-center">
                            
                        </div>
                        <div class="col-span-5 md:col-span-4 flex items-center gap-3">
                            <img src="https://placehold.jp/150x150.png"  class="w-14 h-14 rounded-lg object-cover shadow-sm">
                            <div>
                                <p class="font-medium text-black">T-Shirt</p>
                            </div>
                        </div>
                        <div class="col-span-2 md:col-span-2 text-center md:text-left font-bold text-black">$1.00</div>
                        <div class="col-span-2 md:col-span-3 flex items-center justify-center space-x-1">
                            <span class="font-bold">1</span>
                        </div>
                        <button class="col-span-2 md:col-span-2 text-center text-gray-800 bg-amber-600 text-white py-1 px-2 rounded-md hover:bg-amber-500">Click me</button>
                    </div>

                    <div class="grid grid-cols-12 items-center gap-4 py-4 border-b border-gray-200">
                        <div class="col-span-1 flex justify-center">
                            
                        </div>
                        <div class="col-span-5 md:col-span-4 flex items-center gap-3">
                            <img src="https://placehold.jp/150x150.png"  class="w-14 h-14 rounded-lg object-cover shadow-sm">
                            <div>
                                <p class="font-medium text-black">T-Shirt</p>
                            </div>
                        </div>
                        <div class="col-span-2 md:col-span-2 text-center md:text-left font-bold text-black">$1.00</div>
                        <div class="col-span-2 md:col-span-3 flex items-center justify-center space-x-1">
                            <span class="font-bold">1</span>
                        </div>
                        <button class="col-span-2 md:col-span-2 text-center text-gray-800 bg-amber-600 text-white py-1 px-2 rounded-md hover:bg-amber-500">Click me</button>
                    </div>

                    <div class="grid grid-cols-12 items-center gap-4 py-4">
                        <div class="col-span-1 flex justify-center">
         
                        </div>
                        <div class="col-span-5 md:col-span-4 flex items-center gap-3">
                            <img src="https://placehold.jp/150x150.png"  class="w-14 h-14 rounded-lg object-cover shadow-sm">
                            <div>
                                <p class="font-medium text-black">T-Shirt</p>
                            </div>
                        </div>
                        <div class="col-span-2 md:col-span-2 text-center md:text-left font-bold text-black">$1.00</div>
                        <div class="col-span-2 md:col-span-3 flex items-center justify-center space-x-1">
                            <span class="font-bold">1</span>
                        </div>
                        <button class="col-span-2 md:col-span-2 text-center text-gray-800 bg-amber-600 text-white py-1 px-2 rounded-md hover:bg-amber-500">Click me</button>
                    </div>

                </div>

                <div class="lg:w-1/4 bg-white rounded-xl shadow-md p-6 h-fit">
                    <h2 class="text-xl font-semibold text-black mb-4 pb-3 border-b border-gray-200">Order Summary</h2>
                    <div class="space-y-3 text-gray-600">
                        <div class="flex justify-between items-center">
                            <span>Items</span>
                            <span class="font-medium text-gray-800">1</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Sub Total</span>
                            <span class="font-medium text-gray-800">$1.00</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Shipping</span>
                            <span class="font-medium text-gray-800">$1.00</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Taxes</span>
                            <span class="font-medium text-gray-800">$1.00</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Coupon Discount</span>
                            <span class="font-medium text-red-500">-$1.00</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-gray-200 text-lg font-bold text-gray-900">
                            <span>Total</span>
                            <span>$1.00</span>
                        </div>
                    </div>
                    <button class="mt-6 w-full bg-amber-600 text-white py-3 rounded-xl hover:bg-amber-500 transition duration-300  shadow-md">
                        Proceed to Checkout
                    </button>
                </div>
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

