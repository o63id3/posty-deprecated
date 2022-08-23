@extends('layout')
@section('content')
    <div class="flex justify-center px-5 grid place-items-center lg:grid-cols-3">
        <!-- Left -->
        <div class="hidden pr-64 w-full h-full lg:block">
            <div class="bg-white p-2 rounded-lg shadow-md">
                <ul>
                    <!-- picture, username-->
                    <li class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg w-full dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <div class="flex justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full">
                                    <a data-modal-toggle="{{ "profile-pic-modal" . $user->id }}">
                                        <img class="rounded-full ring-2 ring-green-500  shadow-lg"
                                            @if (file_exists($user->profile_picture))
                                                src="{{ URL::asset($user->profile_picture) }}"
                                            @else
                                                src="{{ URL::asset("./img1.jpg") }}"
                                            @endif
                                        >
                                    </a>
                                </div>
                                <div class="font-medium font-bold">
                                    {{ $user->getName() }}
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Center -->
        <div class="w-full h-full">
            @if (auth()->user() == $user)
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
            @endif

            <p class="m-5 font-bold text-2xl">Posts</p>

            @if ($user->posts->count())
                @foreach ($user->posts->SortByDesc('created_at') as $post)
                    <x-post :post="$post" />
                @endforeach
            @else
                <div class="bg-white p-5 rounded-lg shadow-md mb-3 w-full">
                    <div class="flex justify-center font-3xl">
                        @if (auth()->user()->id == $user->id)
                            <p class="font-bold">You&nbsp</p> have no posts yet!
                        @else
                            <p class="font-bold">{{ $user->first_name }}&nbsp</p> has no posts yet!
                        @endif
                    </div>
                </div>
            @endif

            <!-- Toggle comment area -->
            <script>
                window.addEventListener('DOMContentLoaded', ()=> {
                    const commentBtn = document.querySelectorAll('#comment-btn')
                    const commentBtn2 = document.querySelectorAll('#comment-btn2')
                    const commentArea = document.querySelectorAll('#comment-area')
                    
                    for (let i = 0; i < commentBtn.length; i++) {
                        const btn = commentBtn[i];
                        const btn2 = commentBtn2[i];
                        const area = commentArea[i];
                        
                        btn.addEventListener('click', () => area.classList.toggle('hidden'))
                        btn2.addEventListener('click', () => area.classList.toggle('hidden'))
                    }
                })
            </script>
        </div>

        <!-- Profile picture modal -->
        <div id="{{ "profile-pic-modal" . $user->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex" aria-modal="true" role="dialog">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-transparent rounded-lg">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="{{ "profile-pic-modal" . $user->id }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>  
                        <span class="sr-only">Close modal</span>
                    </button>

                    <!-- Modal header -->
                    <div class="bg-white py-4 px-6 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-base font-semibold text-gray-900 lg:text-xl dark:text-white">
                            {{ $user->first_name }} profile picture
                        </h3>
                    </div>

                    <!-- Modal body -->
                    <div class="h-full overflow-auto">
                        <div class="p-6">
                            <img class="rounded-full shadow-lg"
                                @if (file_exists($user->profile_picture))
                                    src="{{ URL::asset($user->profile_picture) }}"
                                @else
                                    src="{{ URL::asset("./img1.jpg") }}"
                                @endif
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection