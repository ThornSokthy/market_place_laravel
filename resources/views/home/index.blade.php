<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env(".APP_NAME") }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>
<body x-data="{
    showSidebar: window.innerWidth >= 768,
    init() {
        this.$watch('showSidebar', val => {
            if (window.innerWidth >= 768) this.showSidebar = true;
        });
    }
 }">

    <header class="bg-slate-800 text-white px-4 md:px-8 py-4">
        <div class="mb-4 flex justify-between items-center">
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
        <div class="flex justify-between items-center">
            <div>
                <button @click="window.innerWidth < 768 ? showSidebar = !showSidebar : null"
                        @click.outside="showSidebar= false"
                        class="flex items-center gap-1  py-2 px-4 rounded-sm cursor-pointer bg-amber-600 hover:bg-amber-700 transition-colors"
                        aria-label="Toggle categories menu"
                        :aria-expanded="showSidebar">
                    <span class="text-xl"><i class='bx bx-menu-wide'></i></span>
                    <span class="hidden text-[12px] font-semibold md:block">ALL CATEGORIES</span>
                    <span class="text-2xl ml-4 hidden md:block"><i class='bx bx-chevron-down'  ></i> </span>
                </button>
            </div>
            <div class="w-2/3 flex justify-center">
                <input class="w-2/3 bg-white text-black focus:outline-0 py-2 pl-3 rounded-tl-sm rounded-bl-sm" type="text" placeholder="Search...."/>
                <button class="bg-amber-600 text-xl px-4 md:px-6 py-2.5 rounded-tr-sm rounded-br-sm">
                    <i class='bx bx-search'></i>
                </button>
            </div>
            <span class="flex justify-between gap-4">
                <span class="text-3xl"><i class='bx bx-heart'></i> </span>
                <a href="{{ route('orders') }}" class="text-3xl"><i class='bx  bx-shopping-bag-alt'  ></i>  </a>
            </span>
        </div>
    </header>

    <main class="w-full px-6 grid grid-cols-12 gap-4">
        <aside
            x-show="showSidebar"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-x-full md:translate-x-0"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-full md:translate-x-0"
            class="fixed md:static inset-y-0 left-0 z-40 w-64 md:w-full bg-white shadow-lg md:shadow-none md:col-span-3 h-full overflow-y-auto"
        >
            <div class="p-4 space-y-6">
                <div class="block md:hidden">
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

                <div class="cat-section space-y-2">

                    <a href="{{ url()->current() }}"
                       class="flex items-center gap-2 p-2 rounded cursor-pointer transition-colors {{ !$selectedCategory ? 'bg-amber-100/90 font-medium' : 'hover:bg-amber-200' }}">
                        <i class='bx  bx-categories text-lg'  ></i>
                        <span>All Categories</span>
                    </a>

                    @foreach($categories as $categoryName => $iconClass)
                        <a href="{{ request()->fullUrlWithQuery(['category' => $categoryName]) }}"
                           class="flex items-center gap-2 p-2 rounded cursor-pointer transition-colors {{ $selectedCategory == $categoryName ? 'bg-amber-100/90 font-medium' : 'hover:bg-amber-200' }}">
                            <i class='bx {{ $iconClass }} text-lg'></i>
                            <span>{{ $categoryName == 'electronics' ? 'Electronics' : $categoryName }}</span>
                            @isset($categoryCounts)
                                <span class="text-xs text-gray-500 ml-auto">({{ $categoryCounts[$categoryName] ?? 0 }})</span>
                            @endisset
                        </a>
                    @endforeach
                </div>

                <div>
                    <h2 class="mb-4 font-bold text-lg">LATEST PRODUCTS</h2>
                    <div class="latest-product space-y-4">
                        @foreach($latestProducts as $latest)
                            <div class="flex gap-3 items-center p-2 hover:bg-gray-50 rounded">
                                <div class="img">
                                    <img
                                        src="{{ $latest->images->first()->image_url }}"
                                        alt="{{ $latest->title }}"
                                    />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium truncate">{{ $latest->title }}</p>
                                    <span class="text-amber-500 font-semibold">${{ number_format($latest->price, 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        <section class="col-span-full md:col-span-9 h-full mt-3">
            <div x-data="{ showTrendingDropdown: false }" class="flex justify-between items-center relative">
                <div class="bg-slate-700 text-white py-2 px-4">
                    TRENDING ITEMS
                </div>

                <div class="relative">
                    <button
                        @click.stop="showTrendingDropdown = !showTrendingDropdown"
                        class="text-2xl block md:hidden focus:outline-none cursor-pointer"
                        aria-label="Toggle trending items menu"
                    >
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </button>

                    <div
                        x-show="showTrendingDropdown"
                        @click.away="showTrendingDropdown = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-1 w-40 bg-white rounded-md shadow-lg z-50 md:hidden shadow-2xl"
                        style="display: none;"
                    >
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100/90 hover:text-amber-600">ALL</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100/90 hover:text-amber-600">Bathroom</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100/90 hover:text-amber-600">Electronic</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100/90 hover:text-amber-600">Bedroom</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100/90 hover:text-amber-600">Health & Beauty</a>
                        </div>
                    </div>
                </div>

                <div class="hidden md:flex gap-4">
                    <a class="text-amber-600 font-semibold border-b-[3px] pb-1 border-amber-600">ALL</a>
                    <a class="font-medium text-gray-400 hover:text-amber-600 transition-colors">Bathroom</a>
                    <a class="font-medium text-gray-400 hover:text-amber-600 transition-colors">Electronic</a>
                    <a class="font-medium text-gray-400 hover:text-amber-600 transition-colors">Bedroom</a>
                    <a class="font-medium text-gray-400 hover:text-amber-600 transition-colors">Health & Beauty</a>
                </div>
            </div>

            <div class="my-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">

                @foreach($products as $product)
                    <div class="flex flex-col shadow-lg p-2 h-full relative"
                         x-data="{
             currentSlide: 0,
             totalSlides: {{ $product->images->count() }},
             autoSlideInterval: null,
             quantity: 1,
             init() {
                 if (this.totalSlides > 1) {
                     this.startAutoSlide();
                     this.$watch('currentSlide', (value) => {
                         if (value >= this.totalSlides) this.currentSlide = 0;
                         if (value < 0) this.currentSlide = this.totalSlides - 1;
                     });
                 }
             },
             startAutoSlide() {
                 this.autoSlideInterval = setInterval(() => {
                     this.nextSlide();
                 }, 5000);
             },
             stopAutoSlide() {
                 clearInterval(this.autoSlideInterval);
             },
             nextSlide() {
                 this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
             },
             prevSlide() {
                 this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
             },
         }">

                        <div class="w-full aspect-square rounded-sm overflow-hidden mb-2 relative"
                             @mouseenter="stopAutoSlide()"
                             @mouseleave="startAutoSlide()">

                            <div class="relative h-full w-full overflow-hidden">
                                @foreach($product->images as $index => $image)
                                    <div x-show="currentSlide === {{ $index }}"
                                         x-transition:enter="transition ease-out duration-500"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-500"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="absolute inset-0">
                                        <img class="w-full h-full object-cover"
                                             src="{{ $image->image_url }}"
                                             alt="{{ $product->title }} - Image {{ $index + 1 }}"
                                             loading="lazy">
                                    </div>
                                @endforeach
                            </div>

                            @if($product->images->count() > 1)
                                <button x-show="currentSlide > 0"
                                        @click="prevSlide(); stopAutoSlide(); setTimeout(startAutoSlide, 5000);"
                                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/50 hover:bg-white text-gray-800 rounded-full p-2 transition-all">
                                    <i class='bx bx-chevron-left text-xl'></i>
                                </button>

                                <button x-show="currentSlide < totalSlides - 1"
                                        @click="nextSlide(); stopAutoSlide(); setTimeout(startAutoSlide, 5000);"
                                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/50 hover:bg-white text-gray-800 rounded-full p-2 transition-all">
                                    <i class='bx bx-chevron-right text-xl'></i>
                                </button>
                            @endif

                            @if($product->images->count() > 1)
                                <div class="absolute bottom-2 left-0 right-0 flex justify-center gap-1">
                                    @foreach($product->images as $index => $image)
                                        <button @click="currentSlide = {{ $index }}; stopAutoSlide(); setTimeout(startAutoSlide, 5000);"
                                                class="w-2 h-2 rounded-full transition-all"
                                                :class="currentSlide === {{ $index }} ? 'bg-white w-4' : 'bg-white/50'">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col flex-grow px-1 pb-1">
                            <p class="my-1 line-clamp-2 font-medium">{{ $product->title }}</p>

                            <div class="flex flex-col md:flex-row justify-between items-start gap-1 md:items-center">
                                <div class="flex items-center gap-2 my-2">
                                    <button @click="quantity > 1 ? quantity-- : null" class="px-2 bg-gray-200 rounded">
                                        -
                                    </button>
                                    <span x-text="quantity" class="w-6 text-center"></span>
                                    <button @click="quantity++" class="px-2 bg-gray-200 rounded">
                                        +
                                    </button>
                                </div>
                                <div>{{ $product->quantity }} in stock</div>
                            </div>

                            <div class="flex justify-between items-end mt-auto pt-2">
                                <span class="font-semibold">${{ number_format($product->price, 2) }}</span>

                                <form action="{{ route('orders.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="seller_id" value="{{ $product->seller_id }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <input type="hidden" name="quantity" :value="quantity" max="{{ $product->quantity }}">

                                    <button type="submit" class="text-xl py-1 cursor-pointer rounded-sm px-2 bg-slate-600 text-white hover:bg-slate-700 transition">
                                        <i class='bx bx-cart-plus'></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach

                @if(session('success'))
                    <div x-data="{ showSuccess: true }"
                         x-init="setTimeout(() => showSuccess = false, 5000)"
                         x-show="showSuccess"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform translate-y-2"
                         class="absolute right-0 bottom-0 bg-green-100 border-l-4 border-green-500 rounded-sm font-semibold text-green-700 px-4 py-3 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
            <div>
                {{ $products->links('vendor.pagination.custom') }}
            </div>

        </section>
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
