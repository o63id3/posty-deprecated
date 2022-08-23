@props(['comment' => $comment])
<!-- Image -->
<a href="{{ url('/user', $comment->user->username) }}">
    <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
        <img class="rounded-full ring-2 ring-green-500  shadow-lg"
            @if (file_exists($comment->user->profile_picture))
                src="{{ URL::asset($comment->user->profile_picture) }}"
            @else
                src="{{ URL::asset("./img1.jpg") }}"
            @endif
        >
    </span>
</a>

<!-- Content -->
<div class="justify-between items-center p-2 pr-4 bg-white rounded-full border border-gray-200 shadow-sm sm:flex dark:bg-gray-700 dark:border-gray-600">
    <!-- Time -->
    <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mx-0">
        {{ $comment->created_at->diffForHumans() }}
    </time>
    <!-- Text -->
    <div class="px-2 text-sm font-bold font-normal text-black dark:text-gray-300">
        <a href="{{ url('/user', $comment->user->username) }}" class="text-sm font-bold font-normal text-black dark:text-gray-300">
            {{ $comment->user->getName() }}
        </a>
        <div class="pl-2 text-sm font-bold font-normal text-black dark:text-gray-300">
            {{ $comment->comment }}
        </div>
    </div>
</div>

