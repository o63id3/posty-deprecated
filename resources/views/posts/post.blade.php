@extends('layout')
@section('content')
    <div class="flex justify-center px-5 grid w-full lg:grid-cols-3">
        <div></div>
        <div class="w-full h-full lg:col-start-2">
            <x-post :post="$post" />
        </div>
        <div></div>
    </div>
@endsection