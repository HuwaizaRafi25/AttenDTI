<?php $__env->startSection('content'); ?>
    <h1 class="text-4xl lg:block font-semibold text-center mb-8">Welcome Back!</h1>
    <form method="POST" action="<?php echo e(route('loginAct')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <div>
            
            <?php if($errors->any()): ?>
            <div class="bg-red-500/15 text-red-700 rounded-lg p-4 my-3 shadow-md">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="text-sm font-semibold">
                        <?php echo $error; ?>

                    </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <div id="success-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black/50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md text-center transform scale-95 opacity-0 transition-all duration-300 ease-out"
                    id="modal-content">
                    <h2 class="text-lg font-semibold text-green-700 mb-4">Success</h2>
                    <p class="text-sm text-gray-700 mb-6">
                        <?php echo session('success'); ?>

                    </p>
                    <button id="close-modal-btn"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-3 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                        OK
                    </button>
                </div>
            </div>
        <?php endif; ?>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">ITB
                Account</label>
            <input type="email" id="email" name="itb_account"
                <?php if(isset($_COOKIE['email'])): ?> value="<?php echo e($_COOKIE['email']); ?>" <?php else: ?> value="<?php echo e(old('email')); ?>" <?php endif; ?>
                placeholder="Enter your ITB account"
                class="w-full border p-3 rounded-md text-base transition-smooth focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        </div>
        <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password"
                <?php if(isset($_COOKIE['password'])): ?> value="<?php echo e($_COOKIE['password']); ?>" <?php endif; ?>
                class="w-full border p-3 rounded-md text-base transition-smooth focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
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
        <div class="flex items-center justify-between mt-4">
            <div class="cursor-pointer flex items-center">
                <input type="checkbox" id="remember" name="remember"
                    class="h-4 w-4 text-blue-400 cursor-pointer focus:ring-blue-400 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm cursor-pointer text-gray-700">Remember
                    me</label>
            </div>
            <a href="<?php echo e(route('forgotPassword')); ?>"
                class="text-sm text-blue-600 hover:text-blue-800 transition-smooth">Forgot
                Password?</a>
        </div>
        <button type="submit"
            class="w-full bg-blue-500 text-white py-3 px-4 rounded-md text-base font-medium hover:bg-blue-600 transition-smooth mt-6 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
            Login
        </button>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.loginLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/auth/login.blade.php ENDPATH**/ ?>