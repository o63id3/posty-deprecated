@props(['post' => $post])
@php
    $id = $post->id
@endphp
<div class="bg-white px-4 pt-4 rounded-lg shadow-md mb-3 w-full">
    <!-- picture, username, date and options -->
    <div class="flex justify-between p-1 w-full">
        <div class="flex items-center space-x-4 w-full">
            <!-- picture -->
            <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full">
                <a href="{{ url('/user', $post->user->username) }}">
                    <!-- <img class="rounded-full shadow-lg" src="profile-picture-3.jpg" alt="Bonnie image"> -->
                    <img class="rounded-full ring-2 ring-green-500  shadow-lg"
                        @if (file_exists($post->user->profile_picture))
                            src="{{ URL::asset($post->user->profile_picture) }}"
                        @else
                            src="{{URL::asset("./img1.jpg")}}"
                        @endif
                    >
                </a>
            </div>
            <div class="font-medium">
                <!-- Username -->
                <a href="{{ url('/user', $post->user->username) }}" class="font-bold">{{ $post->user->getName() }}</a>

                <!-- Date -->
                <div class="text-sm text-gray-500">
                    <span class="text-gray-800 text-xs font-medium inline-flex items-center py-0.5 rounded mr-2">
                        <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ url('/post', $post) }}" class="text-gray-600 text-sm font-bold">{{ $post->created_at->diffForHumans() }}</a>
                        &nbsp<span aria-hidden="true"> · </span>&nbsp
                        @if ($post->isEdited())
                            <p class="text-gray-600 text-sm">edited</p>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Options -->
        <div class="bg-white">
            <button id="{{ "dropdownButton" . $post->id }}" data-dropdown-toggle="{{ "dropdown" . $post->id }}" class="inline-block text-gray-500 hover:bg-gray-100 rounded-lg text-sm p-1.5" type="button">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                </svg>
            </button>
            
            <!-- Dropdown menu -->
            <div id="{{ "dropdown" . $post->id }}" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow">
                
                <ul class="py-1" aria-labelledby="{{ "dropdownButton" . $post->id }}">
                    @can('update', $post)
                        <li>
                            <button id="{{ "edit-" . $post->id }}"  class="block w-full py-2 text-left px-4 text-sm text-gray-700 hover:bg-gray-100" type="button">
                                Edit
                            </button>
                            {{-- <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Edit</a> --}}
                        </li>
                    @endcan
                    <li>
                        <button id="{{ "copy-link-" . $post->id }}" class="block w-full py-2 text-left px-4 text-sm text-gray-700 hover:bg-gray-100" type="button">
                            Copy link
                        </button>
                        {{-- <a id="{{ "copy-link-" . $post->id }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Copy link</a> --}}
                    </li>
                    @can('delete', $post)
                        <li>
                            <a class="block py-2 px-4 text-sm text-red-600 hover:bg-gray-100" data-modal-toggle="{{ "delete-modal" . $post->id }}">Delete</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div id={{ "post-body-" . $post->id }} class="grid grid-cols-1 divide-y w-full">
        <!-- Body -->
        <p class="m-5 mb-1">
            {{ $post->body }}
        </p>

        <!-- Like Comment Share -->
        <div class="grid grid-cols-1 divide-y mt-3 mb-2">
            <!-- Count -->
            <div class="flex inline gap-3 justify-between p-2 text-sm">
                <!-- Like -->
                <div>
                    @if ($post->likes->count())
                        <button id="likes-btn" class="hover:underline" data-modal-toggle="{{ "likes-modal" . $post->id }}">
                            {{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}
                        </button>
                    @endif
                </div>
                <div class="flex inline gap-3">
                    <!-- Comment -->
                    @if ($post->comments->count())    
                        <button id="{{ "comment-btn-" . $post->id }}" type="button" class="hover:underline">
                            {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
                        </button>
                    @endif

                    <!-- Share -->
                    <button type="button" class="hover:underline">
                        1 Share
                    </button>
                </div>
            </div>

            <!-- Btn -->
            <div class="grid grid-cols-3 divide-x text-center">
                <!-- Like -->
                @auth
                    @if ($post->likedBy(auth()->user()))
                        <form action="{{ route('post.like', $post) }}" method="post">
                            @csrf
                            @method('Delete')
                            <button type="submit" class="text-blue-600 hover:bg-gray-100 font-medium rounded-lg text-l px-5 py-2.5 inline-flex justify-center w-full text-center">Like</button>
                        </form>
                    @else
                        <form action="{{ route('post.like', $post) }}" method="post">
                            @csrf
                            <button type="submit" class="text-black hover:bg-gray-100 font-medium rounded-lg text-l px-5 py-2.5 inline-flex justify-center w-full text-center">Like</button>
                        </form>
                    @endif
                    <button id="{{ "comment-btn2-" . $post->id }}" type="button" class="text-black hover:bg-gray-100 font-medium rounded-lg text-l px-5 py-2.5 inline-flex justify-center w-full text-center">Comment</button>
                    <button type="button" class="text-black hover:bg-gray-100 font-medium rounded-lg text-l px-5 py-2.5 inline-flex justify-center w-full text-center">Share</button>
                @endauth

                @guest
                    <button type="button" class="cursor-not-allowed text-black hover:bg-gray-100 font-medium rounded-lg text-l px-5 py-2.5 inline-flex justify-center w-full text-center" disabled>Like</button>
                    <button id="{{ "comment-btn2-" . $post->id }}" type="button" class="cursor-not-allowed text-black hover:bg-gray-100 font-medium rounded-lg text-l px-5 py-2.5 inline-flex justify-center w-full text-center" disabled>Comment</button>
                    <button type="button" class="text-black hover:bg-gray-100 font-medium rounded-lg text-l px-5 py-2.5 inline-flex justify-center w-full text-center">Share</button>
                @endguest
            </div>

            <!-- Comment area -->
            <div class="hidden bg-gray-50" id="{{ "comment-area-" . $post->id }}">
                <!-- Write comment -->
                <form action="{{ route('post.comment', $post) }}" method="post">
                    @csrf
                    <div class="flex items-center py-2 px-3 rounded-lg w-full h-full">
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
                        </div>

                        <input type="comment" id="comment" name="comment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mx-2" placeholder="Write your comment..." required=""  autocomplete="off">
                        <!-- <textarea id="chat" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300" placeholder="Your message..."></textarea> -->
                        <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                            <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Comments -->
                <div class="mx-8 mt-2">
                    <ol class="relative border-l border-gray-200 dark:border-gray-700">
                        @foreach ($post->comments as $comment)
                            <li class="my-2 ml-6">
                                <x-comment :comment="$comment"/>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit post -->
    <div id={{ "post-edit-" . $post->id }} class="hidden grid grid-cols-1 w-full">
        <!-- Body -->
        <form class="mt-3" action="{{ url('/post', $post) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                <div class="py-2 px-4 bg-white rounded-t-lg dark:bg-gray-800">
                    <textarea id="comment" name="body" rows="4" class="px-0 w-full text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" required="">{{ $post->body }}</textarea>
                </div>

                <div class="flex justify-between items-center py-2 px-3 border-t dark:border-gray-600">
                    <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Edit post
                    </button>
                    <button id={{"cancle-edit" . $post->id }} class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete confirmation modal -->
    <div id="{{ "delete-modal" . $post->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="{{ "delete-modal" . $post->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this post?</h3>

                    <div class="flex justify-center">
                        <form action="{{ url('/post', $post) }}" method="post">
                            @csrf
                            @method('Delete')
                            {{-- <button type="submit" class="text-blue-600 hover:bg-gray-100 font-medium rounded-lg text-l px-5 py-2.5 inline-flex justify-center w-full text-center">Like</button> --}}
                            <button data-modal-toggle="{{ "delete-modal" . $post->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                            
                        <button data-modal-toggle="{{ "delete-modal" . $post->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">
                            No, cancel
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Likes modal -->
    <div id="{{ "likes-modal" . $post->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex" aria-modal="true" role="dialog">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="{{ "likes-modal" . $post->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>  
                    <span class="sr-only">Close modal</span>
                </button>
                <!-- Modal header -->
                <div class="py-4 px-6 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-base font-semibold text-gray-900 lg:text-xl dark:text-white">
                        {{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}
                        
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="h-96 overflow-auto">
                    <div class="p-6">
                        <ul class="space-y-2">
                            @foreach ($post->likes as $like)
                                <li>
                                    <button class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg w-full hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                        <div class="flex justify-between">
                                            <div class="flex items-center space-x-4">
                                                <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full">
                                                    <a href="{{ url('/user', $like->user->username) }}">
                                                        <img class="rounded-full ring-2 ring-green-500  shadow-lg"
                                                            @if (file_exists($like->user->profile_picture))
                                                                src="{{ URL::asset($like->user->profile_picture) }}"
                                                            @else
                                                                src="{{ URL::asset("./img1.jpg") }}"
                                                            @endif
                                                        >
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ url('/user', $like->user->username) }}">{{ $like->user->getName() }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', ()=> {
            const id = '{{ $post->id }}'
            const btn  = document.querySelector('#comment-btn-' + id)
            const btn2 = document.querySelector('#comment-btn2-' + id)
            const area = document.querySelector('#comment-area-' + id)
            const copyLink = document.querySelector('#copy-link-' + id)

            const editBtn = document.querySelector('#edit-' + id)
            const edit = document.querySelector('#post-edit-' + id)
            const body = document.querySelector('#post-body-' + id)
            const dropdown = document.querySelector('#dropdown-' + id)

            if (btn)
                btn.addEventListener('click', () => area.classList.toggle('hidden'))
            
            btn2.addEventListener('click', () => area.classList.toggle('hidden'))

            copyLink.addEventListener('click', () => {
                navigator.clipboard.writeText('http://127.0.0.1:8000/post/' + id);
                alert("link copied!: " + 'http://127.0.0.1:8000/post/' + id);
            })

            editBtn.addEventListener('click', () => {
                edit.classList.toggle('hidden')
                body.classList.toggle('hidden')
            })
        })
    </script>
</div>