@extends('layout')
@section('content')
    <div class="flex justify-center grid place-items-center lg:grid-cols-3">
        <!-- Center -->
        <div class="w-full h-full lg:col-start-2">
            <p class="m-5 font-bold text-2xl">Change password</p>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <form autocomplete="off" method="post" action="{{ url('/password', auth()->user()->username) }}">
                    @csrf
                    @method('PUT')

                    <!-- Old password -->
                    <div class="mb-4">
                        <input type="password" id="password" name="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('old_password') border-red-500 @enderror" placeholder="Old password" required="">
                        @error('old_password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> 

                    <!-- Password -->
                    <div class="mb-4">
                        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('password') border-red-500 @enderror" placeholder="New password" required="">
                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> 

                    <!-- Confirm password -->
                    <div class="mb-4">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Confirm new password" required="">
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Change</button>
                </form>
            </div>
        </div>
    </div>
@endsection