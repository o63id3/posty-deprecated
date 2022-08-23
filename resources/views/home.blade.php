@extends('layout')
@section('content')
    <div class="flex justify-center px-5 grid place-items-center md:grid-cols-3">
        <!-- Left -->
        <div class="hidden pr-16 w-full h-full md:block lg:pr-64">
            @auth
            <div class="bg-white p-2 rounded-lg shadow-md">
                <ul>
                    <!-- picture, username-->
                    <li>
                        <a href="{{ url('/user', auth()->user()->username) }}">
                            <button class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg w-full hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <div class="flex justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full">
                                            <img class="rounded-full ring-2 ring-green-500  shadow-lg"
                                                @if (file_exists(auth()->user()->profile_picture))
                                                    src="{{ URL::asset(auth()->user()->profile_picture) }}"
                                                @else
                                                    src="{{ URL::asset("./img1.jpg") }}"
                                                @endif
                                            >
                                        </div>
                                        <div class="font-medium">
                                            {{ auth()->user()->getName() }}
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
            @endauth
        </div>

        <!-- Center -->
        <div class="w-full h-full md:col-span-2 lg:col-span-1">
            @auth
                <!-- What's on your mind, username? -->
                <div class="bg-white p-4 rounded-lg shadow-md mb-3 w-full">
                    <div class="font-bold text-center">
                        <!-- Write comment -->
                        <form action="/post" method="post">
                            @csrf
                            <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg w-full h-full">
                                <div class="flex items-center space-x-4">
                                    <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full">
                                        <a href="{{ url('/user', auth()->user()->username) }}">
                                            <img class="rounded-full ring-2 ring-green-500  shadow-lg"
                                                @if (file_exists(auth()->user()->profile_picture))
                                                    src="{{ URL::asset(auth()->user()->profile_picture) }}"
                                                @else
                                                    src="{{ URL::asset("./img1.jpg") }}"
                                                @endif
                                            >
                                        </a>
                                    </div>
                                </div>
        
                                <input type="text" id="body" name="body" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mx-2" placeholder="{{ "What's on your mind, " . auth()->user()->first_name . "?" }}" required="" autocomplete="off">
                                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                                    <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endauth

            @foreach ($posts as $post)
                <x-post :post="$post" />
            @endforeach

            {{ $posts->links() }}
        </div>
        
        <!-- Right -->
        <div class="hidden pl-64 w-full h-full lg:block">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <div class="font-bold text-center">Contacts</div>
            </div>
        </div>
    </div>
@endsection