
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
                            src="{{ Auth::user()->profile_picture
                                ? Auth::user()->profile_picture
                                : 'https://randomuser.me/api/portraits/men/1.jpg'
                            }}"
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

<main class="px-4 sm:px-16 md:px-20 lg:px-28 w-full md:max-w-2/3 mx-auto">

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col items-center mb-8">
                    <div class="relative mb-4" x-data="{ previewUrl: '{{ Auth::user()->profile_picture
                                ? Auth::user()->profile_picture
                                : 'https://randomuser.me/api/portraits/men/1.jpg' }}' }">
                        <img id="profile-preview" :src="previewUrl" alt="Profile Picture"
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">
                        <label for="profile-upload"
                               class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2 cursor-pointer hover:bg-blue-600">
                            <i class='bx  bx-camera-alt'  ></i>
                            <input id="profile-upload" name="profile_picture" type="file" accept="image/*"
                                   class="hidden"
                                   @change="
                               const file = $event.target.files[0];
                               if (file) {
                                   const reader = new FileReader();
                                   reader.onload = (e) => {
                                       previewUrl = e.target.result;
                                   };
                                   reader.readAsDataURL(file);
                               }
                           ">
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="mt-8 border-t pt-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Address Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="street" class="block text-sm font-medium text-gray-700 mb-1">Street *</label>
                            <input type="text" id="street" name="street" value="{{ old('street', $address->street ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="commune" class="block text-sm font-medium text-gray-700 mb-1">Commune *</label>
                            <input type="text" id="commune" name="commune" value="{{ old('commune', $address->commune ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District *</label>
                            <input type="text" id="district" name="district" value="{{ old('district', $address->district ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $address->city ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $address->postal_code ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="md:col-span-2 flex items-center">
                            <input type="checkbox" id="is_default" name="is_default" value="1"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                {{ old('is_default', $address->is_default ?? false) ? 'checked' : '' }}>
                            <label for="is_default" class="ml-2 block text-sm text-gray-700">Set as default address</label>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="button" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md mr-4 cursor-pointer hover:bg-gray-400">
                        <a href="{{ route('profile') }}">Cancel</a>
                    </button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md cursor-pointer hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </form>
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

