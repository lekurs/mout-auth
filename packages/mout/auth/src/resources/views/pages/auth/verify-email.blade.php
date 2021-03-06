@extends('laravel-auth::layouts.auth')
@section('content')
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="/">
            <h1 class="text-center text-4xl font-extrabold text-indigo-600 hover:text-indigo-500">{{ config('app.name') }}</h1>
        </a>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-200">
            @lang('laravel-auth::laravel-auth.verify.title')
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-blue-gray-800 py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="{{ route('verification.send') }}" method="POST">
                @csrf
                <div class="text-gray-200">
                    @lang('laravel-auth::laravel-auth.verify.text')
                </div>
                @if (session('status') === 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    @lang('laravel-auth::laravel-auth.verify.submit')
                </button>
            </form>
        </div>
    </div>
@endsection
