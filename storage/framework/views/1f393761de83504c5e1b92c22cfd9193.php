<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg text-center">
        <h1 class="text-4xl font-bold text-red-600">404</h1>
        <h2 class="text-xl font-semibold mt-4">View Not Found</h2>
        <?php if(!empty($message)): ?>
            <p class="mt-4 text-gray-800 font-medium">
                <?php echo e($message); ?>

            </p>
        <?php endif; ?>
        <?php if(Auth::check() && Auth::user()->hasRole('admin')): ?>
            <a href="<?php echo e(url('/dashboard')); ?>"
                class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                Back to Home
            </a>
        <?php else: ?>
            <a href="<?php echo e(url('/overview')); ?>"
                class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                Back to Home
            </a>
        <?php endif; ?>
    </div>
</body>

</html>
<?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/errors/view_not_found.blade.php ENDPATH**/ ?>