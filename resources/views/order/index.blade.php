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
            <a href="{{ route('home') }}" class="text-2xl font-bold">
                <span class="text-red-500">H</span>
                <span class="text-blue-500">a</span>
                <span class="text-green-500">P</span>
                <span class="text-yellow-500">p</span>
                <span class="text-purple-500">E</span>
                <span class="text-pink-500">n</span>
                <span class="text-indigo-500">O</span>
            </a>
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

    <main class="w-full py-6 px-4 sm:px-16 md:px-16 lg:px-36">

        <h1 class="mb-2 text-3xl font-semibold text-center ">Shopping Cart</h1>
        <div class="text-center text-sm font-semibold text-gray-600">
            <a>Home</a>
            <span>/</span>
            <a>Shopping Cart</a>
        </div>

        <div class="flex flex-col md:flex-row  justify-between gap-12 mt-8">
            <div class="flex-1/3">

                <div class="bg-amber-400 py-2 rounded-md mt-6 px-2 flex items-center justify-between text-sm font-semibold text-gray-600 uppercase">
                    <div class="flex items-center gap-6">
                        <span class="w-6 md:w-12"></span>
                        <span class="min-w-[8rem]">Product</span>
                    </div>
                    <div class="text-center min-w-[4rem]">Qty</div>
                    <div class="min-w-[6rem] text-center">Action</div>
                </div>

                <div class="mt-3 space-y-4">

                    @foreach($orders as $order)

                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between gap-4 border-b border-gray-200 hover:bg-gray-50 transition-all duration-200 rounded-lg cart-row mb-2">
                                <div class="flex items-center gap-1.5 md:gap-6">

                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="transition-colors cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>

                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 sm:h-16 sm:w-16 rounded-md overflow-hidden shadow-sm">
                                            @php
                                                $primaryImage = $item->product->images->where('is_primary', 1)->first();
                                            @endphp
                                            <img class="w-full h-full object-cover"
                                                 src="{{ $primaryImage->image_url ?? ($item->product->images->first()->image_url ?? 'https://via.placeholder.com/100') }}"
                                                 alt="{{ $item->product->title ?? 'Product' }}" />
                                        </div>
                                        <div>
                                            {{ Str::limit($item->product->title ?? 'Unknown Product', 15) }}
                                            <p class="text-xs text-gray-500">${{ number_format($item->price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-center space-x-2 quantity-controls">
                                    <span class="font-bold text-gray-800 min-w-[1.5rem] text-center">{{ $item->quantity }}</span>
                                </div>

                                <div x-data="{ showDropdown: false }" class="relative">
                                    <button
                                        @click="showDropdown = !showDropdown"
                                        @click.away="showDropdown = false"
                                        class="text-white cursor-pointer flex items-center gap-1.5 bg-amber-400 hover:bg-amber-500 px-2.5 py-1 rounded-md transition-colors"
                                    >
                                        <span><i class='bx bx-phone-forwarding'></i></span>
                                        <span class="text-md font-semibold hidden sm:block">Contact</span>
                                    </button>

                                    <div
                                        x-show="showDropdown"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200"
                                    >
                                        <div class="py-1">
                                            <div class="px-4 py-2 rounded-tl-md rounded-tr-md text-sm text-gray-700 border-b bg-amber-300">
                                                <p class="font-medium">Contact Seller</p>
                                            </div>
                                            <a
                                                href="tel:{{ $order->seller->phone }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100/90 "
                                            >
                                                <div class="flex items-center gap-2">
                                                    <i class='bx bx-mobile-alt text-gray-500'></i>
                                                    <span>{{ $order->seller->phone }}</span>
                                                </div>
                                            </a>
                                            @if($order->seller->email)
                                                <a
                                                    href="mailto:{{ $order->seller->email }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100/90"
                                                >
                                                    <div class="flex items-center gap-2">
                                                        <i class='bx bx-envelope text-gray-500'></i>
                                                        <span>{{ $order->seller->email }}</span>
                                                    </div>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    @endforeach

                        @if(session('cancel_success'))
                            <div x-data="{ show: true }"
                                 x-init="setTimeout(() => show = false, 5000)"
                                 x-show="show"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform translate-y-2"
                                 class="absolute left-0 bottom-0 bg-green-100 border-l-4 border-green-500 rounded-sm font-semibold text-green-700 px-4 py-3 mb-4">

                                 {{ session('cancel_success') }}

                            </div>
                        @endif

                </div>

            </div>

            <div class="max-w-full md:max-w-[400px] w-full px-8 pt-6 pb-10 rounded-xl drop-shadow-2xl border border-gray-300 h-fit">
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
                <button class="mt-6 w-full bg-amber-600 text-white py-3 rounded-full hover:bg-amber-500 transition duration-300  shadow-md">
                    Proceed to Checkout
                </button>
            </div>
        </div>

    </main>

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

