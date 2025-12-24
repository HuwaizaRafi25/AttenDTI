<?php if($users->isEmpty()): ?>
    <tr>
        <td colspan="6" class="text-center p-4 text-sm font-medium">
            User Not Found.
        </td>
    </tr>
<?php else: ?>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="border-b border-gray-200 hover:bg-gray-100"
            data-id="<?php echo e($user->id); ?>"
            data-identity_number="<?php echo e($user->identity_number); ?>"
            data-username="<?php echo e($user->username); ?>"
            data-itb-account="<?php echo e($user->itb_account); ?>"
            data-email="<?php echo e($user->email); ?>"
            data-phone="<?php echo e($user->phone); ?>"
            data-fullname="<?php echo e($user->full_name); ?>"
            data-gender="<?php echo e($user->gender); ?>"
            data-address="<?php echo e($user->address); ?>"
            data-profile-pic="<?php echo e($user->profile_pic); ?>"
            data-period-start="<?php echo e($user->period_start_date ? $user->period_start_date : ''); ?>"
            data-period-end="<?php echo e($user->period_end_date ? $user->period_end_date : ''); ?>"
            data-major="<?php echo e($user->major ? $user->major : ''); ?>"
            data-institution="<?php echo e($user->institution ? $user->institution : ''); ?>"
            data-placement="<?php echo e($user->placement ? $user->placement->name : ''); ?>"
            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                data-role="<?php echo e($role->name); ?>"
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            >
            <td class="py-3 px-6 text-center whitespace-nowrap"><?php echo e($loop->iteration); ?></td>
            <td class="py-3 px-6 text-left">
                <div class="flex items-center">
                    <img src="<?php echo e($user->profile_pic ? asset('storage/profilePics/' . $user->profile_pic) : asset('assets/images/userPlaceHolder.png')); ?>"
                        alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                    <div class="w-4 h-4 mt-5 -ml-2.5 flex items-center justify-center rounded-full bg-white">
                        <?php if($user->isOnline()): ?>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        <?php else: ?>
                            <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                        <?php endif; ?>
                    </div>
                    <div class="ml-2">
                        <span class="block font-semibold text-gray-800"><?php echo e($user->full_name ? $user->full_name : 'N/A'); ?></span>
                        <span class="block text-sm text-gray-500 no-print"><?php echo e('@'.$user->username); ?></span>
                    </div>
                </div>
            </td>
            <td class="py-3 px-6 text-left printable hidden">
                <p class="font-semibold text-gray-800"><?php echo e($user->itb_account); ?></p>
            </td>
            <td class="py-3 pl-6 text-left">
                <span class="text-[#187bcd] text-base font-semibold rounded-md">
                    <?php echo $user->hasRole('admin')
                        ? '<p class="p-1 px-2 bg-[#6770c6]/30 rounded-md w-fit">DTI ITB</p>'
                        : ($user->institution
                            ? $user->institution
                            : 'B/T'); ?>

                </span>
            </td>
            <td class="py-3 px-6 text-center opacity-80">
                <?php if($user->roles->isEmpty()): ?>
                    <span class="text-white bg-yellow-400 px-2 py-1 rounded-md">Unassigned</span>
                <?php else: ?>
                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-blue-400 min-w-[100px] py-1 rounded-md inline-block text-center">
                            <span class="text-white"><?php echo e($role->name); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </td>
            <td class="py-3 px-6 text-center no-print">
                <div class="flex item-center justify-center">
                    <a href="#"
                        class="view-button w-4 mr-2 scale-125 transform hover:text-green-500 hover:scale-150 transition duration-75">
                        <span class="icon">
                            <?php echo file_get_contents(public_path('assets/images/icons/showAlt.svg')); ?>

                        </span>
                    </a>
                    <a href="<?php echo e(route('users.updateView', $user->id)); ?>"
                        class="w-4 mr-2 scale-125 transform hover:text-indigo-500 hover:scale-150 transition duration-75">
                        <span
                            class="bx bx-edit w-4 mr-2 scale-125 transform hover:text-green-500 hover:scale-150 transition duration-75">
                            <span class="icon">
                                <?php echo file_get_contents(public_path('assets/images/icons/editBold.svg')); ?>

                            </span>
                        </span>
                    </a>
                    <a href="#" data-user-id="<?php echo e($user->id); ?>" data-user-nama="<?php echo e($user->nama); ?>"
                        data-user-email="<?php echo e($user->email); ?>" data-user-pic="<?php echo e($user->profile_pic); ?>"
                        class="delete-button w-4 mr-2 scale-125 transform hover:text-red-500 hover:scale-150 transition duration-75">
                        <span class="icon">
                            <?php echo file_get_contents(public_path('assets/images/icons/delete.svg')); ?>

                        </span>
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/menus/tables/user_table.blade.php ENDPATH**/ ?>