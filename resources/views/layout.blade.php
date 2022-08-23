<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <title>Posty</title>

    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
</head>
<body class="bg-gray-200 dark:bg-gray-900">
    <nav class="z-50 sticky top-0 p-3 px-4 bg-white flex justify-between shadow-md mb-6 dark:bg-gray-700">
        <!-- Left -->
        <ul class="flex items-center">
            <!-- Logo -->
            <li>
                <a href="/">
                    <div class="inline-flex overflow-hidden relative justify-center items-center w-10 h-10 bg-gray-100 rounded-full">
                        <span class="font-medium text-gray-600">P</span>
                    </div>
                </a>
            </li>

            <!-- Search -->
            <li class="hidden md:block">
                <div class="ml-3">
                    <form action="{{ route('search') }}" method="GET">
                        {{-- @csrf --}}
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" id="default-search" class="block pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Posts..." required="" autocomplete="off"/>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-sm rounded-lg text-sm px-2">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </li>
        </ul>

        <!-- Right -->
        <ul class="flex items-center">
            @guest
                <!-- Login -->
                <li>
                    <a href="/login" class="p-3 text-blue-700 font-bold">Login</a>
                </li>

                <!-- Register -->
                <li>
                    <a href="/register" class="p-3 dark:text-white">Register</a>
                </li>
            @endguest

            <li class="hidden">
                <button id="theme-toggle" type="button" class="bg-gray-200 text-white-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
            </li>

            @auth
                <!-- User dropdown -->
                <li>
                    <!-- Image -->
                    <div class="overflow-hidden relative w-10 h-10 ml-3 bg-gray-100 rounded-full">
                        <img id="avatarButton" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="rounded-full ring-2 ring-green-500  shadow-lg"
                            @if (file_exists(auth()->user()->profile_picture))
                               src="{{ URL::asset(auth()->user()->profile_picture) }}"
                            @else
                                src="{{ URL::asset("./img1.jpg") }}"
                            @endif
                        >
                    </div>

                    <!-- Dropdown menu -->
                    <div id="userDropdown" class="hidden w-44 bg-white rounded divide-y divide-gray-100 shadow block" data-popper-placement="bottom-start">
                        <!-- User name -->
                        <div class="py-3 px-4 text-sm text-gray-900">
                            {{ auth()->user()->getName() }}
                        </div>

                        <!-- Pages -->
                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="avatarButton">
                            <li>
                                <a href="{{ url('/user', auth()->user()->username) }}" class="block py-2 px-4 hover:bg-gray-100">Profile</a>
                            </li>
                            <li>
                                <a href="{{ url('/password') }}" class="block py-2 px-4 hover:bg-gray-100">Change Passowrd</a>
                            </li>
                            <li>
                                <a href="{{ url('/settings') }}" class="block py-2 px-4 hover:bg-gray-100">Settings</a>
                            </li>
                        </ul>

                        <!-- Log out -->
                        <div class="py-1">
                            <form action="/logout" method="post" class="block py-2 px-4 text-sm text-red-700 hover:bg-gray-100">
                                @csrf
                                <button type="submit">Sign out</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endauth
        </ul>
    </nav>
    @yield('content')
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    @yield('scripts')
</body>
</html>