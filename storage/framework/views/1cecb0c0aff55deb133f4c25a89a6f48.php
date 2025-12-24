<?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activityLog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="border-b border-gray-200 hover:bg-gray-100" data-profile-image="<?php echo e($activityLog->profile_picture); ?>"
        data-name="<?php echo e($activityLog->name); ?>" data-email="<?php echo e($activityLog->email); ?>"
        data-contacts="<?php echo e($activityLog->contact_info); ?>" data-address="<?php echo e($activityLog->address); ?>"
        data-id="<?php echo e($activityLog->id); ?>">
        <td class="py-3 px-6 text-left whitespace-nowrap">
            <div class="flex flex-col">
                <div class="font-semibold text-sm">
                    <?php echo e($activityLog->created_at->format('d M, Y')); ?>

                </div>
                <div>
                    <?php echo e($activityLog->created_at->format('H:i:s')); ?>

                </div>
            </div>
        </td>
        <td class="py-3 pl-3 text-left">
            <div class="flex items-center">
                <img src="<?php echo e($activityLog->user->profile_pic ? asset('storage/profilePics/' . $activityLog->user->profile_pic) : asset('assets/images/userPlaceHolder.png')); ?>"
                        alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                <div class="flex flex-col items-left ml-2 gap-y-1">
                    <span
                    class="block font-semibold text-gray-800"><?php echo e($activityLog->user ? $activityLog->user->username : 'Not found'); ?></span>
                    <span
                    class="block font-semibold bg-blue-500 w-min px-2 rounded-md py-1 text-white"><?php echo e($activityLog->user ? $activityLog->user->roles->first()->name : 'Not found'); ?></span>
                </div>
            </div>
        </td>
        <td class="py-3 pl-3 text-center">
            <?php echo e($activityLog->event); ?>

        </td>
        
        <td class="py-3 px-3 text-left">
            <?php echo e($activityLog->description); ?>

        </td>
        
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/menus/tables/activity_log_table.blade.php ENDPATH**/ ?>