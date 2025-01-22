@extends('auth.loginLayout')
@section('content')
    <div class="flex flex-col items-center gap-2 mb-4">
        <h1 class="text-3xl lg:block font-bold text-center">New Password</h1>
        <p class="text-base lg:block text-center font-base text-gray-600">Please enter a new password</p>
    </div>
    <form method="POST" action="{{ route('validateForgotPasswordAct') }}" class="space-y-4">
        @csrf
        <div class="relative">
            <input type="hidden" name="token" id="token" value="{{ $token }}">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input type="password" required id="password" name="password" placeholder="Enter your new password"
                @if (isset($_COOKIE['password'])) value="{{ $_COOKIE['password'] }}" @endif
                class="w-full border p-3 rounded-md text-base transition-smooth focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('password') border-red-500 @enderror">
            <button type="button" id="togglePassword"
                class="absolute right-3 top-[68%] transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New
                Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                placeholder="Confirm your new password"
                class="w-full border p-3 rounded-md text-base transition-smooth focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('password_confirmation') border-red-500 @enderror">
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 px-4 rounded-md text-base font-medium hover:bg-blue-600 transition-smooth mt-6 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
            Reset Password
        </button>

        <div class="text-blue-500 hover:scale-105 transition-all duration-200">
            <a href="{{ route('login') }}" class="flex gap-2 items-center justify-center">
                <i class="fa-solid fa-arrow-right transform scale-x-[-1]"></i>
                <p class="text-sm font-medium transition-smooth">
                    Back to login</p>
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
    <script src="{{ asset('assets/js/forgotPassword.js') }}"></script>
@endsection
