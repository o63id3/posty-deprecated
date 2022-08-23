@extends('layout')
@section('content')
    <div class="flex justify-center grid grid-cols-3 place-items-center">
        <!-- Center -->
        <div class="col-start-2 w-full h-full">
            <p class="m-5 font-bold text-2xl">Register</p>
            <div class="bg-white p-6 rounded-lg shadow-md">
            
                <form autocomplete="off" method="post" action="/register">
                    @csrf
                    <!-- Name -->
                    <div class="grid gap-4 mb-4 md:grid-cols-2">
                        <div>
                            <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('first_name') border-red-500 @enderror" placeholder="First name" required="" value="{{ old('first_name') }}">
                            @error('first_name')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('last_name') border-red-500 @enderror" placeholder="Last name" required="" value="{{ old('last_name') }}">
                            @error('last_name')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email   -->
                    <div class="mb-4">
                        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-500 @enderror" placeholder="Email address" required="" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-4">
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            @
                            </span>
                            <input type="text" id="username" name="username" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 @error('email') border-red-500 @enderror" placeholder="Username" value="{{ old('username') }}">
                        </div>
                        @error('username')
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
                        <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Confirm password" required="">
                    </div>
                    
                    <!-- Profile picture -->
                    <div class="mb-4">
                        <label class="ml-2 text-sm text-gray-900">Your picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" class="@error('password') border-red-500 @enderror"  value="{{ old('profile_picture') }}" accept="image/png, image/jpeg">
                        @error('profile_picture')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Register</button>
                </form>

            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            const inputElement = document.querySelector('input[id="profile_picture"]');
            const pond = FilePond.create(inputElement);
            FilePond.setOptions({
                server: {
                    acceptedFileTypes: ['image/png'],
                    url: '/upload',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
        </script>
    @endsection
@endsection