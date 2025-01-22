@extends('auth.loginLayout')
@section('content')
    <div class="flex flex-col items-center gap-2 mb-4">
        <h1 class="text-3xl lg:block font-bold text-center">Forgot password?</h1>
        <p class="text-base lg:block text-center font-base text-gray-600">No worries, we'll send
            you reset instruction</p>
    </div>
    <form method="POST" action="{{ route('forgotPasswordAct') }}" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" id="email" name="email"
                @if (isset($_COOKIE['email'])) value="{{ $_COOKIE['email'] }}" @else value="{{ old('email') }}" @endif
                placeholder="Enter your email"
                class="w-full border p-3 rounded-md text-base transition-smooth focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('email') border-red-500 @enderror">
        </div>
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 px-4 rounded-md text-base font-medium hover:bg-blue-600 transition-smooth mt-6 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
            Reset Password
        </button>
        <div class="text-blue-500 hover:scale-105 transition-all duration-200">
            <a href="{{ route('login') }}" class="flex gap-2 items-center justify-center">
                <i class="fa-solid fa-arrow-right transform scale-x-[-1]"></i>
                <p class="text-sm font-medium transition-smooth">
                    Back to
                    login</p>
            </a>
        </div>
        @if ($errors->any())
            <div class="bg-red-500/15 text-red-700 rounded-lg p-4 my-3 shadow-md">
                @foreach ($errors->all() as $error)
                    <p class="text-sm font-semibold">
                        {!! $error !!}
                    </p>
                @endforeach
            </div>
        @endif
    </form>
    @if (session('success'))
        <div id="success-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black/50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md text-center transform scale-95 opacity-0 transition-all duration-300 ease-out"
                id="modal-content">
                <h2 class="text-lg font-semibold text-green-700 mb-4">Success</h2>
                <p class="text-sm text-gray-700 mb-6">
                    {!! session('success') !!}
                </p>
                <button id="close-modal-btn"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-3 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                    OK
                </button>
            </div>
        </div>
    @endif
@endsection
