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
                    <span class="hidden text-[12px] font-semibold md:block">ALL CATEGORIES</span>
                    <span class="text-2xl ml-4 hidden md:block"><i class='bx bx-chevron-down'  ></i> </span>
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

    <main class="w-full px-6 grid grid-cols-12 gap-4">
        <aside class="col-span-3 h-full hidden md:block">
            <div class="cat-section">
                <div>
                    <i class='bx bx-gift'  ></i>
                    <span>Gifts & Toys</span>
                </div>
                <div>
                    <i class='bx bx-ev-station'  ></i>
                    <span>Electronics</span>
                </div>
                <div>
                    <i class='bx bx-dress'  ></i>
                    <span>Fashion & Accessories</span>
                </div>
                <div>
                    <i class='bx bx-sneaker'  ></i>
                    <span>Begs & Shoes</span>
                </div>
                <div>
                    <i class='bx bx-bath'  ></i>
                    <span>Bathroom</span>
                </div>
                <div>
                    <i class='bx bx-heart-plus'  ></i>
                    <span>Health & Beauty</span>
                </div>
                <div>
                    <i class='bx bx-garage'  ></i>
                    <span>Home & Light</span>
                </div>
                <div>
                    <i class='bx bx-bed'  ></i>
                    <span>Bedroom</span>
                </div>
            </div>
            <div>
                <h2 class="mb-4">LATEST PRODUCTS</h2>
                <div class="latest-product">
                    <div>
                        <div class="img">
                            <img src="https://d2v5dzhdg4zhx3.cloudfront.net/web-assets/images/storypages/primary/ProductShowcasesampleimages/JPEG/Product+Showcase-1.jpg" alt="" />
                        </div>
                        <div>
                            <p>Adidas shoes</p>
                            <span class="text-amber-500">$64.00</span>
                        </div>
                    </div>
                    <div>
                        <div class="img">
                            <img src="https://plus.unsplash.com/premium_photo-1664392147011-2a720f214e01?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D" alt="" />
                        </div>
                        <div>
                            <p>Girl beg</p>
                            <span class="text-amber-500">$64.00</span>
                        </div>
                    </div>
                    <div>
                        <div class="img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1Z2hl8RAvyhzhHYErVp_wc_31v59q5N9w-dJQa2fSaN5pa-HInoxYoZ3_07VjDtEXN30&usqp=CAU" alt="" />
                        </div>
                        <div>
                            <p>Beauty product</p>
                            <span class="text-amber-500">$64.00</span>
                        </div>
                    </div>
                    <div>
                        <div class="img">
                            <img src="https://d2v5dzhdg4zhx3.cloudfront.net/web-assets/images/storypages/primary/ProductShowcasesampleimages/JPEG/Product+Showcase-1.jpg" alt="" />
                        </div>
                        <div>
                            <p>Adidas shoes</p>
                            <span class="text-amber-500">$64.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <section class="col-span-full md:col-span-9 h-full mt-3">
            <div class="flex justify-between items-center">
                <div class="bg-slate-700 text-white py-2 px-4">
                    TRENDING ITEMS
                </div>
                <span class="text-2xl block md:hidden"><i class='bx bx-dots-vertical-rounded'  ></i> </span>
                <div class="hidden md:flex gap-4">
                    <a class="text-amber-600 font-semibold border-b-[3px] pb-1">ALL</a>
                    <a class="font-medium text-gray-400">Bathroom</a>
                    <a class="font-medium text-gray-400">Electronic</a>
                    <a class="font-medium text-gray-400">Bedroom</a>
                    <a class="font-medium text-gray-400">Health & Beauty</a>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">
                <div class="flex flex-col shadow-lg p-2">
                    <div class="w-full h-full rounded-sm overflow-hidden">
                        <img class="w-full h-full object-cover" src="https://d2v5dzhdg4zhx3.cloudfront.net/web-assets/images/storypages/primary/ProductShowcasesampleimages/JPEG/Product+Showcase-1.jpg" alt="" />
                    </div>
                    <div>
                        <p class="my-2">Adidas shoes</p>
                        <div class="flex justify-between items-end">
                            <span>$64.00</span>
                            <span class="text-xl py-1 cursor-pointer rounded-sm px-2 bg-slate-600 text-white"><i class='bx bx-cart-plus'  ></i> </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col shadow-lg p-2">
                    <div class="w-full h-full rounded-sm overflow-hidden">
                        <img class="w-full h-full object-cover" src="https://plus.unsplash.com/premium_photo-1664392147011-2a720f214e01?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D" alt="" />
                    </div>
                    <div>
                        <p class="my-2">Adidas shoes</p>
                        <div class="flex justify-between items-end">
                            <span>$64.00</span>
                            <span class="text-xl py-1 cursor-pointer rounded-sm px-2 bg-slate-600 text-white"><i class='bx bx-cart-plus'  ></i> </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col shadow-lg p-2">
                    <div class="w-full h-full rounded-sm overflow-hidden">
                        <img class="w-full h-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1Z2hl8RAvyhzhHYErVp_wc_31v59q5N9w-dJQa2fSaN5pa-HInoxYoZ3_07VjDtEXN30&usqp=CAU" alt="" />
                    </div>
                    <div>
                        <p class="my-2">Adidas shoes</p>
                        <div class="flex justify-between items-end">
                            <span>$64.00</span>
                            <span class="text-xl py-1 cursor-pointer rounded-sm px-2 bg-slate-600 text-white"><i class='bx bx-cart-plus'  ></i> </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col shadow-lg p-2">
                    <div class="w-full h-full rounded-sm overflow-hidden">
                        <img class="w-full h-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLcW90dVPhS7TDm-rr3jmjoneXpcH2g-2SmpYYtQbT_r4HUy-SxwIVDWwlX2E_916F0nY&usqp=CAU" alt="" />
                    </div>
                    <div>
                        <p class="my-2">Adidas shoes</p>
                        <div class="flex justify-between items-end">
                            <span>$64.00</span>
                            <span class="text-xl py-1 cursor-pointer rounded-sm px-2 bg-slate-600 text-white"><i class='bx bx-cart-plus'  ></i> </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col shadow-lg p-2">
                    <div class="w-full h-full rounded-sm overflow-hidden">
                        <img class="w-full h-full object-cover" src="https://m.media-amazon.com/images/I/61ttw0sasbL.jpg" alt="" />
                    </div>
                    <div>
                        <p class="my-2">Adidas shoes</p>
                        <div class="flex justify-between items-end">
                            <span>$64.00</span>
                            <span class="text-xl py-1 cursor-pointer rounded-sm px-2 bg-slate-600 text-white"><i class='bx bx-cart-plus'  ></i> </span>
                        </div>
                    </div>
                </div>
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
