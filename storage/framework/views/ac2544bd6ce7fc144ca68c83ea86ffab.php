<?php $__env->startSection('content'); ?>
    <style>
        #userModal {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            /* Awalnya disembunyikan */
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.5s ease;
            z-index: 1000;
            transform: translateY(20);
        }

        #userModal.show {
            transition: 0.5s ease;
            display: flex;
            /* Menampilkan modal */
            opacity: 1;
            transform: translateY(0);
            /* Menampilkan efek muncul */
        }

        .full-screen-image {
            width: auto;
            height: auto;
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            border-radius: 15px;
            /* Menjaga proporsi gambar */
        }

        #deleteModal.show {
            display: flex;
            z-index: 101
        }

        #addModal {
            z-index: 101;
        }

        #addModal.show {
            display: flex
        }

        #updateModal {
            z-index: 101;
        }

        #updateModal .show {
            display: flex
        }

        #imageOverlay {
            display: none;
            /* Sembunyikan overlay secara default */
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* Untuk Firefox */
            -webkit-appearance: none;
            /* Untuk Chrome dan Safari */
            appearance: none;
            /* Untuk browser lain */
        }

        /* Sembunyikan spinner */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #optionsMenu.show {
            display: block;
            position: absolute !important;
            left: 44px;
            margin-top: 24px;
            z-index: 50;
            width: 128px;
        }

        #moreButton.open+#optionsMenu {
            display: block;
        }

        [x-cloak] {
            display: none;
        }
    </style>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('expenses')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="">
        
        <div>
            <div class="flex flex-col ml-8">
                <div class="flex">
                    <button id="work" class="ml-1.5 mr-4 text-blue-500 font-semibold">
                        Role Permission
                    </button>
                    <button id="done" class="mr-4">
                        User Permission
                    </button>
                </div>
                <!-- Tambahkan hr setelah button pertama -->
                <hr id="underline" class="ml-1 w-0 border-blue-500 mb-3"
                    style="border-width: 1.5px; transition: 0.5s ease;">
            </div>
            <div id="qcOps" class="max-w-7xl mx-auto sm:px-6 lg:px-8 transition-all duration-500 opacity-100">
                <div class="bg-white shadow-xl sm:rounded-lg p-6 flex w-full flex-col h-auto  items-center">
                    <div class="w-full flex justify-between h-auto px-4">
                        <div class="w-4/6">
                            <span class="text-gray-600">Action</span>
                        </div>
                        <div class="space-x-7 w-2/6 flex justify-end">
                            <span>Alumni</span>
                            <span>User</span>
                            <span>Admin</span>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-1">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/user_group.svg')); ?>" class="w-6 opacity-85" alt="">
                        <span class="font-semibold opacity-90">Accounts Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read User Account</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage User Account</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Role Permission</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Activity Log</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/attendance_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Attendances Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Attendance</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Record Attendance</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Attendance</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/building_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Locations Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Location</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Location</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/job_blue.svg')); ?>" class="w-5 opacity-85" alt="">
                        <span class="font-semibold opacity-90">Jobs Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Job Vacancy</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Job Vacancy</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/announcement_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Announcements Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Announcement</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Announcement</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/document_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Documents Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Create Document</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Users Document</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Users Document</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="accomplishedQcTable"
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 transition-all transform ease-in-out duration-500 opacity-0 hidden">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    
                    <div class="flex justify-end mb-4">
                        <button id="linkUserPermission"
                            class="linkUserPermissionButton bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                            <i class="fa-solid fa-link"></i>
                            Assign User
                        </button>
                    </div>
                    <div class="w-full flex justify-between h-auto px-4">
                        <div class="w-4/6">
                            <span class="text-gray-600">Action</span>
                        </div>
                        <div class="space-x-7 w-2/6 flex justify-end">
                            <span>User Account</span>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-1">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/user_group.svg')); ?>" class="w-6 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Accounts Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read User Account</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['read_user']) || $groupedPermissions['read_user']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['read_user']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>

                        
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage User Account</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['manage_user_account']) || $groupedPermissions['manage_user_account']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['manage_user_account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>

                        
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Role Permission</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['manage_role_permission']) || $groupedPermissions['manage_role_permission']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['manage_role_permission']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>

                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Activity Log</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['read_activity_log']) || $groupedPermissions['read_activity_log']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['read_activity_log']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/attendance_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Attendances Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Attendance</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['read_attendance']) || $groupedPermissions['read_attendance']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['read_attendance']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Record Attendance</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['record_attendance']) || $groupedPermissions['record_attendance']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['record_attendance']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Attendance</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['manage_attendance']) || $groupedPermissions['manage_attendance']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['manage_attendance']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/building_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Locations Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Location</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['read_location']) || $groupedPermissions['read_location']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['read_location']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Location</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['manage_location']) || $groupedPermissions['manage_location']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['manage_location']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/job_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Jobs Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Job Vacancy</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['read_job']) || $groupedPermissions['read_job']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['read_job']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Job Vacancy</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['manage_job']) || $groupedPermissions['manage_job']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['manage_job']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/announcement_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Announcements Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Announcement</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['read_announcement']) || $groupedPermissions['read_announcement']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['read_announcement']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Announcement</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['manage_announcement']) || $groupedPermissions['manage_announcement']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['manage_announcement']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="<?php echo e(asset('assets/images/icons/document_blue.svg')); ?>" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Others</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Dues</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                <?php if(!isset($groupedPermissions['manage_dues']) || $groupedPermissions['manage_dues']->isEmpty()): ?>
                                    <span class="text-gray-400">User Not Found</span>
                                <?php else: ?>
                                    <?php $__currentLoopData = $groupedPermissions['manage_dues']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="<?php echo e($mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png')); ?>"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800"><?php echo e($mp->user->username); ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="<?php echo e(route('userPermission.unlink', $mp->user->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <input type="hidden" name="permission"
                                                        value="<?php echo e($mp->permission->name); ?>">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="<?php echo e(asset('assets/images/icons/unlink_blue.svg')); ?>"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const underLine = document.getElementById('underline');
            const workButton = document.getElementById('work');
            const doneButton = document.getElementById('done');
            const workTable = document.getElementById('qcOps');
            const doneTable = document.getElementById('accomplishedQcTable');

            function setActiveButton(activeButton, inactiveButton) {
                activeButton.classList.add('text-blue-500', 'font-semibold');
                inactiveButton.classList.remove('text-blue-500', 'font-semibold');

                const activeButtonRect = activeButton.getBoundingClientRect();
                underLine.style.width = `${activeButtonRect.width}px`;
                underLine.style.marginLeft =
                    `${activeButtonRect.left - workButton.getBoundingClientRect().left + 3}px`;
            }

            function switchTables(showTable, hideTable) {
                // Fade out the current table
                hideTable.style.opacity = '0';
                hideTable.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    hideTable.classList.add('hidden');
                    showTable.classList.remove('hidden');

                    // Trigger reflow
                    void showTable.offsetWidth;

                    // Fade in the new table
                    showTable.style.opacity = '1';
                    showTable.style.transform = 'translateY(0)';
                }, 300); // Match this with your CSS transition duration
            }

            doneButton.addEventListener('click', function() {
                setActiveButton(doneButton, workButton);
                switchTables(doneTable, workTable);
            });

            workButton.addEventListener('click', function() {
                setActiveButton(workButton, doneButton);
                switchTables(workTable, doneTable);
            });

            // Initial setup
            setActiveButton(workButton, doneButton);

            const linkUserPermissionButton = document.querySelectorAll('.linkUserPermissionButton');
            const linkUserPermission = document.getElementById('linkUserPermission');
            const closeButton = document.querySelectorAll('.closeLinkUser');

            linkUserPermissionButton.forEach(button => {
                button.addEventListener('click', function() {
                    linkUserPermission.classList.remove('hidden');
                    linkUserPermission.classList.add('flex');
                });
            });

            closeButton.forEach(button => {
                button.addEventListener('click', function() {
                    linkUserPermission.classList.add('hidden');
                    linkUserPermission.classList.remove('flex');
                });
            });

            document.addEventListener('click', function(event) {
                if (event.target === linkUserPermission) {
                    linkUserPermission.classList.add('hidden');
                    linkUserPermission.classList.remove('flex');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/menus/role_permission.blade.php ENDPATH**/ ?>