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

    <div
        x-data="{
            showDeleteModal: false,
             deleting: false,
             deleteItem: null,
             showModal: false,
             isEditing: false,
             currentPost: {
                    title: '',
                    description: '',
                    category: '',
                    price: 1,
                    quantity: 1
                },
            files: [],
            previews: [],
            imagesToDelete: [],

            initForm(post = null) {
                this.isEditing = post !== null;
                this.currentPost = post || {
                    title: '',
                    description: '',
                    category: '',
                    price: 1,
                    quantity: 1
                }
                this.files = [];
                this.previews = post?.images?.map(item => ({
                    id: item.id,
                    url: item.image_url,
                    isExisting: true
                })) || [];
                this.imagesToDelete = [];
            },

            handleFileSelect(event) {
                const selectedFiles = Array.from(event.target.files);
                this.files = selectedFiles;
                this.previews = this.previews.filter(p => p.isExisting);
                selectedFiles.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previews.push({
                            id: Date.now() + Math.random().toString(36).substring(2),
                            url: e.target.result,
                            file: file,
                            isExisting: false
                        });
                    };
                    reader.readAsDataURL(file);
                });
            },
            removePreview(index) {
                const preview = this.previews[index];
                if (preview.isExisting) {
                    this.imagesToDelete.push(preview.id);
                } else {
                    const fileIndex = this.files.findIndex(f => f.name === preview.file.name);
                    if (fileIndex !== -1) {
                        this.files.splice(fileIndex, 1);
                    }
                }
                this.previews.splice(index, 1);
            }
        }"
        class="relative w-full max-w-full mx-auto bg-white shadow-sm overflow-hidden">

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

                    <button
                        class="bg-amber-500 px-5 py-2 rounded-md text-sm font-medium cursor-pointer text-white hover:bg-amber-600 transition-colors"
                        @click="initForm(); showModal = true"
                    >
                        Add Post
                    </button>

                    <div
                        x-show="showModal"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="px-3 pb-5 max-w-[480px] h-fit overflow-y-auto mx-auto bg-white drop-shadow-2xl rounded-md bg-opacity-75 transition duration-150 ease-in-out z-10 fixed top-8 right-0 bottom-0 left-0"
                        style="display: none;"
                        @click.away="showModal = false"
                    >
                        <div class=" p-4 rounded-lg m-auto max-w-md">
                            <h2 class="text-xl font-bold mb-4" x-text="isEditing ? 'Edit Post' : 'Add Post'"></h2>
                            <form
                                :action="isEditing ? '/posts/' + currentPost.id : '/posts'"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <template x-if="isEditing">
                                    @method('PUT')
                                </template>

                                <div>
                                    <label for="title" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Title</label>
                                    <input id="title" class="mb-3 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                           name="title"
                                           placeholder="Title"
                                           x-model="currentPost.title"
                                    />
                                </div>

                                <div class="mb-3 relative">
                                    <label for="category" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Category</label>
                                    <div class="relative">
                                        <select
                                            id="category"
                                            class="mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 pr-8 text-sm border-gray-300 rounded border appearance-none bg-white "
                                            name="category"
                                            required
                                            x-model="currentPost.category"
                                        >
                                            <option value="electronics" selected>Electronics</option>
                                            <option value="Gifts & Toys">Gifts & Toys</option>
                                            <option value="Fashion & Accessories">Fashion & Accessories</option>
                                            <option value="Bags & Shoes">Bags & Shoes</option>
                                            <option value="Bathroom">Bathroom</option>
                                            <option value="Health & Beauty">Health & Beauty</option>
                                            <option value="Home & Light">Home & Light</option>
                                            <option value="Bedroom">Bedroom</option>
                                        </select>

                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 top-1/2 transform -translate-y-1/2">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between mb-3">
                                    <div>
                                        <label for="price" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Price</label>
                                        <input id="price" class=" mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                               name="price"
                                               step="0.01"
                                                min="0.01"
                                                value="1.00"
                                               type="number"
                                               placeholder="Price"
                                               x-model="currentPost.price"
                                        />
                                    </div>
                                    <div>
                                        <label for="quantity" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Quantity</label>
                                        <input id="quantity" class=" mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                               name="quantity"
                                               value="1"
                                               min="1"
                                               type="number"
                                               placeholder="Quantity"
                                               x-model="currentPost.quantity"
                                        />
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Description</label>
                                    <textarea
                                        id="description"
                                        class="mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full flex items-center pl-3 pt-2 text-sm border-gray-300 rounded border"
                                        name="description"
                                        rows="4"
                                        placeholder="Enter post description"
                                        x-text="currentPost?.description"
                                    ></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Images</label>
                                    <div class="mt-2">

                                        <template x-for="id in imagesToDelete" :key="id">
                                            <input type="hidden" name="images_to_delete[]" :value="id" />
                                        </template>

                                        <div x-show="previews.length === 0" class="flex items-center justify-center w-full">
                                            <label class="flex flex-col w-full h-32 border-2 border-dashed rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all cursor-pointer">
                                                <div class="flex flex-col items-center justify-center pt-7">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <p class="pt-1 text-sm tracking-wider text-gray-400">Click to upload or drag and drop</p>
                                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG up to 5MB</p>
                                                </div>
                                                <input
                                                    type="file"
                                                    name="images[]"
                                                    class="opacity-0 absolute"
                                                    multiple
                                                    accept="image/*"
                                                    @change="handleFileSelect($event)"
                                                />
                                            </label>
                                        </div>

                                        <div x-show="previews.length > 0" class="mt-4">
                                            <div>
                                                <div class="flex justify-between items-center mb-2">
                                                    <h4 class="text-sm font-medium text-gray-700">Selected Images</h4>
                                                    <button
                                                        type="button"
                                                        @click="previews = []; files = [];"
                                                        class="text-xs text-indigo-600 hover:text-indigo-800"
                                                    >
                                                        Clear All
                                                    </button>
                                                </div>
                                                <div class="grid grid-cols-4 gap-3">
                                                    <template x-for="(preview, index) in previews" :key="preview.id">
                                                        <div class="relative group h-16">
                                                            <img
                                                                :src="preview.url"
                                                                class="w-full h-full object-cover rounded border"
                                                                :alt="'Preview ' + (index + 1)"
                                                            >
                                                            <button
                                                                type="button"
                                                                @click="removePreview(index)"
                                                                class="absolute cursor-pointer top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                                                aria-label="Remove image"
                                                            >
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>

                                                <button
                                                    type="button"
                                                    @click="$refs.fileInput.click()"
                                                    class="mt-3 text-sm text-indigo-600 hover:text-indigo-800 flex items-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    Add more images
                                                </button>
                                                <input
                                                    x-ref="fileInput"
                                                    type="file"
                                                    name="images[]"
                                                    class="hidden"
                                                    multiple
                                                    accept="image/*"
                                                    @change="handleFileSelect($event)"
                                                />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="flex items-center justify-start w-full">
                                    <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm"><span x-text="isEditing ? 'Update' : 'Submit'"></span></button>
                                    <button @click="showModal = false" class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalHandler()">Cancel</button>
                                </div>
                            </form>

                        </div>
                    </div>

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

            @if($products->isNotEmpty())
                <div class="my-6 px-4 sm:px-16 md:px-20 lg:px-28 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">

                    @foreach($products as $product)
                            <div class="flex flex-col shadow-lg p-2 h-full relative"
                                 x-data="{
                                 open: false,
                                 currentSlide: 0,
                                 totalSlides: {{ $product->images->count() }},
                                 autoSlideInterval: null,
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
                                         this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                                     }, 5000);
                                 },
                                 stopAutoSlide() {
                                     clearInterval(this.autoSlideInterval);
                                 },
                                 nextSlide() {
                                     this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                                     this.stopAutoSlide();
                                     setTimeout(() => this.startAutoSlide(), 5000);
                                 },
                                 prevSlide() {
                                     this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                                     this.stopAutoSlide();
                                     setTimeout(() => this.startAutoSlide(), 5000);
                                 }
                             }">

                            <div class="w-full aspect-square rounded-sm overflow-hidden mb-2 relative"
                                 @mouseenter="stopAutoSlide()"
                                 @mouseleave="startAutoSlide()">

                                <div class="relative h-full w-full overflow-hidden">
                                    @foreach($product->images as $index => $image)
                                        <div x-show="currentSlide === {{ $index }}"
                                             x-transition:enter="transition ease-out duration-300"
                                             x-transition:enter-start="opacity-0"
                                             x-transition:enter-end="opacity-100"
                                             x-transition:leave="transition ease-in duration-300"
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
                                            @click="prevSlide()"
                                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/50 rounded-full p-2 text-gray-800 hover:bg-white transition">
                                        <i class='bx bx-chevron-left text-xl'></i>
                                    </button>

                                    <button x-show="currentSlide < {{ $product->images->count() - 1 }}"
                                            @click="nextSlide()"
                                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/50 rounded-full p-2 text-gray-800 hover:bg-white transition">
                                        <i class='bx bx-chevron-right text-xl'></i>
                                    </button>
                                @endif

                                @if($product->images->count() > 1)
                                    <div class="absolute bottom-2 left-0 right-0 flex justify-center gap-1">
                                        @foreach($product->images as $index => $image)
                                            <button @click="currentSlide = {{ $index }}; stopAutoSlide(); setTimeout(() => startAutoSlide(), 5000);"
                                                    class="w-2 h-2 rounded-full transition-all"
                                                    :class="currentSlide === {{ $index }} ? 'bg-white w-4' : 'bg-white/50'">
                                            </button>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="absolute top-2 right-2">
                                    <span class="text-2xl py-1 cursor-pointer rounded-full w-8 h-8 flex items-center justify-center bg-white/80 text-gray-800 hover:bg-white transition-all"
                                          @click="open = !open"
                                          @click.outside="open = false">
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col flex-grow px-2 pb-1.5">
                                <p class="my-1 line-clamp-2">{{ $product->title }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $product->created_at->diffForHumans() }} by
                                    <span class="text-cyan-500">{{ $product->seller->first_name }} {{ $product->seller->last_name }}</span>
                                </p>
                                <div class="flex justify-between items-end mt-4">
                                    <span>${{ number_format($product->price, 2) }}</span>
                                    <p>{{ $product->quantity }} in stock</p>
                                </div>
                            </div>

                            <div class="absolute top-8 right-0 mt-1 w-32 bg-white rounded-md shadow-lg py-1 z-50 transition-all duration-200 ease-out origin-top-right"
                                 x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 style="display: none">

                                <a href="#"
                                   @click.prevent="initForm({{ $product->toJson() }}); showModal = true"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100/90 hover:text-blue-600 transition-all duration-200 ease-in-out">
                                    <i class='bx bx-edit mr-2'></i>Edit
                                </a>


                                <button
                                    @click="showDeleteModal = true; deleteItem = {{ $product->id }}"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100/90 hover:text-red-700 transition-all duration-200 ease-in-out"
                                >
                                    <i class='bx bx-trash mr-2'></i>Delete
                                </button>

                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="grid place-content-center h-1/2">
                    <h2 class="text-2xl text-blue-950">No Post Available</h2>
                </div>
            @endif

        </div>

        <div class="absolute top-1/3 right-0 left-0 mx-auto mt-1 w-[340px] bg-white rounded-md shadow-lg py-1 z-50 transition-all duration-200 ease-out origin-top-right"
             x-show="showDeleteModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             style="display: none"
        >

            <div class="bg-white rounded-lg shadow-xl w-full max-w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900">Confirm Deletion</h3>
                    <p class="mt-2 text-sm text-gray-600">Are you sure you want to delete this item? This action cannot be undone.</p>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">

                        <form
                            :action="`/posts/${deleteItem}`" method="POST"
                            @submit="deleting = true"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                :disabled="deleting"
                            >
                                <span x-show="!deleting">Delete</span>
                                <span x-show="deleting" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Deleting...
                                </span>
                            </button>
                        </form>

                        <button
                            @click="showDeleteModal = !showDeleteModal"
                            type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            :disabled="deleting"
                        >
                            Cancel
                        </button>
                    </div>
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

