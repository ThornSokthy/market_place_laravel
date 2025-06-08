<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="py-16">
        <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-[426px] md:max-w-[500px] lg:max-w-5xl">
            <div class="hidden lg:block lg:w-1/2 bg-cover"
                 style="background-image:url('https://images.unsplash.com/photo-1546514714-df0ccc50d7bf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=667&q=80')">
            </div>
            <div class="w-full lg:w-7/12">
                <h2 class="text-2xl font-semibold text-gray-700 text-center">Brand</h2>
                <p class="text-xl text-gray-600 text-center">Create an Account!</p>

                <form class="px-10 pt-6 pb-12 mb-4 bg-white rounded">
                    <div class="mb-4 md:flex md:justify-between">
                        <div class="mb-4 md:mr-2 md:mb-0">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">
                                First Name
                            </label>
                            <input
                                class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                                id="firstName"
                                type="text"
                                placeholder="First Name"
                            />
                        </div>
                        <div class="md:ml-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">
                                Last Name
                            </label>
                            <input
                                class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"                                id="lastName"
                                type="text"
                                placeholder="Last Name"
                            />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input
                            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"                            id="email"
                            type="email"
                            placeholder="Email"
                        />
                    </div>
                    <div class="mb-4 md:flex md:justify-between">
                        <div class="mb-4 md:mr-2 md:mb-0">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                Password
                            </label>
                            <input
                                class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-red-500 rounded py-2 px-4 block w-full appearance-none"                                id="password"
                                type="password"
                                placeholder="Password"
                            />
                            <p class="text-xs italic text-red-500">Please choose a password.</p>
                        </div>
                        <div class="md:ml-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="c_password">
                                Confirm Password
                            </label>
                            <input
                                class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"                                id="c_password"
                                type="password"
                                placeholder="Confirm Password"
                            />
                        </div>
                    </div>
                    <div class="mb-6 text-center">
                        <button
                            class="bg-gray-700 cursor-pointer text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600"
                            type="button"
                        >
                            Register Account
                        </button>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="border-b w-1/5 md:w-1/4"></span>
                        <a href="#" class="text-xs text-gray-500 uppercase">or sign in</a>
                        <span class="border-b w-1/5 md:w-1/4"></span>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>
