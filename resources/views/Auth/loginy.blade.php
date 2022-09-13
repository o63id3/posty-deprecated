@extends('layout')
@section('content')

<div class="flex justify-center grid grid-cols-3 place-items-center">
    <!-- Center -->
    <div class="col-start-2 w-4/5 h-full">
        <p class="m-5 font-bold text-2xl">Login</p>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form autocomplete="off" method="post" action="/login">
                @csrf
                <!-- Username -->
                <div class="mb-6">
                    <div class="flex">
                        <span class="@if (session('status')) border-red-500 @endif inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                          @
                        </span>
                        <input type="text" name="username" class="@if (session('status')) border-red-500 @endif rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Username">
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <input type="password" name="password" class="@if (session('status')) border-red-500 @endif bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"  placeholder="Password" required="">
                </div>

                @if (session('status'))
                    <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Remember -->
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value="" class="w-4 h-4 bg-gray-50 rounded border border-gray-300">
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900">Remember me</label>
                </div>

                <!-- Login -->
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Login</button>
            </form>
        </div>
    </div>
</div>

@endsection