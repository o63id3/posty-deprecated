@extends('layout')
@section('content')
    <div class="flex justify-center">
        <div class="w-4/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">Login</h1>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            <form action="/login" method="post">
                @csrf
                <!-- Username -->
                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                <div class="mb-6">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600" >
                            @
                        </span>
                        <input type="text" name="username" id="username" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @if (session('status')) border-red-500 @endif" placeholder="johndoe" value="{{ old('username') }}">
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @if (session('status')) border-red-500 @endif" placeholder="•••••••••" required="">
                
                    @if (session('status'))
                        <div class="text-red-500 mt-2 text-sm">
                                {{ session('status') }}
                        </div>
                    @endif

                    <!-- err -->
                    {{-- <div class="text-red-500 mt-2 text-sm">
                        @error('status')
                            {{ $message }}
                        @enderror
                    </div> --}}
                </div>

                <!-- Remmber -->
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value="" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                    </div>
                    <label for="remember" name="remember" id="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400">Remember me</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>
@endsection