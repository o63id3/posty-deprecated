@extends('layout')
@section('content')
    <div class="flex justify-center">
        <div class="w-5/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium">Editing</h1>
            </div>
        </div>
    </div>

    <div class="flex justify-center mb-3">
        <div class="w-5/12 bg-white p-6 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full dark:bg-gray-600">
                    <a href="">
                        <svg class="absolute -left-1 w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                <div class="font-medium dark:text-white">
                    <a href="" class="font-bold">{{ auth()->user()->getName() }}</a>
                </div>
            </div>

            <form action="{{ url("/post/{$post->id}") }}" method="post">
                @csrf
                @method('PUT')
                <div class="mt-4 mb-4 w-full bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                    <div class="py-2 px-4 bg-white rounded-t-lg dark:bg-gray-800">
                        <textarea id="body" name="body" rows="6" class="px-0 w-full text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" required="">{{ $post->body }}</textarea>
                    </div>
                    <div class="flex justify-between items-center py-2 px-3 border-t dark:border-gray-600">
                        <button type="submit" class="w-35 inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-blue-900 hover:bg-red-800">
                            Update
                        </button>
                        <a href="{{ url("/post/{$post->id}") }}" class="">
                            Cancle
                        </a>
                    </div>
                </div>
            </form>
            <p class="ml-auto text-xs text-gray-500 dark:text-gray-400">Remember, contributions to this topic should follow our <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">Community Guidelines</a>.</p>
        </div>
    </div>
@endsection