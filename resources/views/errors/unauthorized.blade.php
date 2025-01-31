<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted</title>
    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Sesuaikan dengan setup asset Anda -->
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md px-4">
        <!-- Slot untuk custom illustration -->
        <div class="mb-8 text-blue-500">
            <svg class="w-32 h-32 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h1 class="text-2xl font-bold text-gray-600 mb-4">Access Restricted</h1>
            <p class="text-gray-500 mb-6">
                Oops! It seems you don't have the necessary privileges to view this content.
                If this is unexpected, please contact your system administrator.
            </p>

            <div class="space-y-4">
                <a href="{{ route('overview') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
                    <span class="mr-2">&larr;</span>
                    Return to Overview

                    <div class="text-sm text-gray-400">
                        Error Reference: #{{ substr(md5(uniqid()), 0, 8) }} <!-- ID unik untuk logging -->
                    </div>
                </a>
            </div>
        </div>
    </div>

    <x-notify::notify />
    @notifyJs
</body>

</html>
