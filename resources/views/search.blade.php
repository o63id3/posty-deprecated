@extends('layout')
@section('content')
    <div class="flex justify-center px-5 grid place-items-center lg:grid-cols-3">
        <div class="w-full h-full md:col-start-2">
            <div class="bg-white p-5 rounded-lg shadow-md mb-3 w-full">
                <div class="flex justify-center font-3xl">
                    <p>
                        @if ($posts->isEmpty() && $users->isEmpty())
                            No results found for:&nbsp<p class="font-bold">{{ $search }}</p>!
                        @else
                            Results for:&nbsp<p class="font-bold">{{ $search }}</p>
                        @endif
                    </p>
                </div>
            </div>

            @if ($users->isNotEmpty())
                <p class="m-5 font-bold text-2xl">Users</p>
                <div class="bg-white p-4 rounded-lg shadow-md mb-3 w-full">
                    <div class="">
                        <ul>
                            @foreach ($users as $user)
                                <!-- picture, username-->
                                <li class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg w-full dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <div class="flex justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full">
                                                <img class="rounded-full shadow-lg"
                                                    @if (file_exists($user->profile_picture))
                                                        src="{{ URL::asset(auth()->user()->profile_picture) }}"
                                                    @else
                                                        src="{{ URL::asset("./img1.jpg") }}"
                                                    @endif
                                                >
                                            </div>
                                            <div class="font-medium font-bold">
                                                <a href="{{ url('/user', $user->username) }}">
                                                    {{ $user->getName() }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            @if ($posts->isNotEmpty())
                <p class="m-5 font-bold text-2xl">Posts</p>

                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach
            @endif
        </div>
    </div>
@endsection