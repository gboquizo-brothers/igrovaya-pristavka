@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="absolute top-0 right-0 mt-4 mr-4">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Log out @fas('sign-out-alt')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                               hreflang="{{ $localeCode }}"
                               class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                {{ ucfirst($properties['native']) }}
                            </a>
                        @endforeach
                    @else
                        <a href="{{ route('login') }}"
                           class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <div class="flex items-center justify-center">
            <div class="flex flex-col justify-around">
                <a href="{{ route('home') }}">
                    @include('components.logo', ['attributes' => 'w-auto h-16 mx-auto text-indigo-600'])
                </a>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h1 class="text-5xl font-extrabold tracking-wider text-center text-gray-600">
                    @lang('home.title')
                </h1>
                <div class="text-center">
                    @auth
                        @lang('home.sign_in')
                    @else
                        @lang('home.guest')
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
