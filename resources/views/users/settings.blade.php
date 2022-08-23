@extends('layout')
@section('content')
    <div class="flex justify-center grid place-items-center lg:grid-cols-3">
        <!-- Center -->
        <div class="w-full h-full lg:col-start-2">
            <p class="m-5 font-bold text-2xl">Settings</p>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <form autocomplete="off" method="post" action="{{ url('/settings', auth()->user()->username) }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Name -->
                    <div class="grid gap-4 mb-4 md:grid-cols-2">
                        <div>
                            <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="First name" required="" value="{{ $user->first_name }}">
                        </div>
                        <div>
                            <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Last name" required="" value="{{ $user->last_name }}">
                        </div>
                    </div>

                    <!-- Email   -->
                    <div class="mb-4">
                        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Email address" required="" value="{{ $user->email }}">
                    </div>

                    <!-- Username -->
                    <div class="mb-4">
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            @
                            </span>
                            <input type="text" id="username" name="username" class="cursor-not-allowed rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Username" value="{{ $user->username }}" disabled>
                        </div>
                    </div>

                    <div class="justify-center">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save changes</button>
                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection