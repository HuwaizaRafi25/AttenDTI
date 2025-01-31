<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Method Not Allowed</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg text-center">
        <h1 class="text-4xl font-bold text-red-600">405</h1>
        <h2 class="text-xl font-semibold mt-4">Method Not Allowed</h2>
        <p class="mt-2 text-gray-600">
            The method you used is not supported for this route.
        </p>
        @if (!empty($message))
            <p class="mt-4 text-gray-800 font-medium">
                {{ $message }}
            </p>
        @endif
        @if (Auth::check() && Auth::user()->hasRole('admin'))
            <a href="{{ url('/dashboard') }}"
                class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                Back to Home
            </a>
        @else
            <a href="{{ url('/overview') }}"
                class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                Back to Home
            </a>
        @endif
    </div>
</body>

</html>
