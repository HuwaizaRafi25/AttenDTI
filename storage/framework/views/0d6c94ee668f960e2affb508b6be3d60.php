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
            <div id="qcOps"
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 transition-all gap-x-6 gap-y-4 grid grid-cols-1 md:grid-cols-2 duration-500 opacity-100">
                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white shadow-xl sm:rounded-lg p-4 relative flex w-full h-auto items-center">
                        <div class="w-2/5 h-full">
                            <img src="<?php echo e(asset('storage/locationPics/' . $location->pic)); ?>"
                                class="object-cover w-full h-full rounded-md shadow-md" alt="">
                        </div>
                        <div class="w-3/5 h-full flex flex-col items-start justify-start p-4">
                            <h1 class="font-bold text-lg"><?php echo e($location->campus); ?></h1>
                            <hr class="w-full my-1 border">
                            <h2 class="font-normal text-sm text-gray-800"><?php echo e($location->name); ?>

                            </h2>
                            <div class="my-2 space-y-2">
                                <div class="flex items-center w-full opacity-60 gap-x-2">
                                    <img src="<?php echo e(asset('assets/images/icons/envelope.svg')); ?>" class="w-4 h-4"
                                        alt="">
                                    <span class="text-sm"><?php echo e($location->email_address); ?></span>
                                </div>
                                <div class="flex items-start w-full opacity-60 gap-x-2">
                                    <img src="<?php echo e(asset('assets/images/icons/pin.svg')); ?>" class="w-4 h-4 mt-1"
                                        alt="">
                                    <span class="text-sm leading-snug"><?php echo e($location->address); ?></span>
                                </div>
                                <div class="flex flex-col items-center justify-center w-full gap-2">
                                    <iframe
                                        src="https://maps.google.com/maps?q=<?php echo e($location->latitude); ?>,<?php echo e($location->longitude); ?>&t=&z=15&ie=UTF8&iwloc=&output=embed"
                                        height="164" class="w-full" style="border:0;" class="rounded-md shadow-sm"
                                        allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    <span class="text-xs mt-1 font-semibold text-gray-600">Lat: <?php echo e($location->latitude); ?>

                                        Long:
                                        <?php echo e($location->longitude); ?></span>
                                </div>
                            </div>
                        </div>
                        <img src="<?php echo e(asset('assets/images/icons/editBold.svg')); ?>"
                            class="w-4 absolute top-2 right-4 cursor-pointer opacity-75 hover:opacity-100 hover:scale-125 transition-all transform"
                            alt="">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
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
        });
    </script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const approveButtons = document.querySelectorAll('.work-button');
            const workModal = document.getElementById('workModal');
            const closeWorkModal = document.getElementById('closeWorkModal');
            const workForm = document.getElementById('workForm');

            approveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const designId = this.getAttribute('data-qcOp-id');
                    const designIdReq = this.getAttribute('data-qcOp-idReq');
                    const designPic = this.getAttribute('data-qcOp-pic');
                    const designName = this.getAttribute('data-qcOp-name');
                    const designMax = this.getAttribute('data-qcOp-maxStore');
                    const operatorId = this.getAttribute('data-qcOp-operatorId');
                    const qcName = this.getAttribute('data-qcOp-qcName');

                    workForm.querySelector('img#designReference').src = `/${designPic}`;
                    workForm.querySelector('input[name="designName"]').value = designName;
                    workForm.querySelector('input[name="Qc"]').value = qcName;
                    workForm.querySelector('input[name="operatorId"]').value = operatorId;
                    workForm.querySelector('input[name="designId"]').value = designId;
                    workForm.querySelector('input[name="designReqId"]').value = designIdReq;
                    workForm.querySelector('#maxValue').textContent = designMax;
                    workForm.querySelector('input[name="quantity"]').max =
                        designMax; // Tampilkan modal
                    workModal.classList.remove('hidden');
                    workModal.classList.add('flex');
                    console.log(referenceImage); // Debugging
                });
            });

            // Tutup modal saat tombol "Close" diklik
            closeWorkModal.addEventListener('click', function() {
                workModal.classList.add('hidden');
                workModal.classList.remove('flex');
            });

            // Tutup modal saat area di luar modal diklik
            workModal.addEventListener('click', function(e) {
                if (e.target === workModal) {
                    workModal.classList.add('hidden');
                    workModal.classList.remove('flex');
                }
            });
        });
    </script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewButton = document.querySelectorAll('.view-button');
            const viewModal = document.getElementById('viewModal');
            const closeModal = document.getElementById('closeViewModal');

            viewButton.forEach(button => {
                button.addEventListener('click', function() {
                    const pic = this.getAttribute('data-pic');
                    const name = this.getAttribute('data-name');
                    const sizeW = this.getAttribute('data-sizeW');
                    const sizeH = this.getAttribute('data-sizeH');
                    const colors = this.getAttribute('data-colors');
                    const desc = this.getAttribute('data-desc');
                    viewModal.querySelector('img#requestPic').src = `/${pic}`;
                    viewModal.querySelector('#requestName').textContent = name;
                    viewModal.querySelector('#sizeW').textContent = sizeW + 'CM';
                    viewModal.querySelector('#sizeH').textContent = sizeH + 'CM';
                    viewModal.querySelector('#requestColors').textContent = colors;
                    viewModal.querySelector('#requestDesc').textContent = desc;

                    viewModal.classList.remove('hidden');
                    viewModal.classList.add(
                        'flex');
                });
            });

            closeModal.addEventListener('click', function() {
                viewModal.classList.add('hidden');
                viewModal.classList.remove('flex');
            });

            viewModal.addEventListener('click', function(e) {
                if (e.target === viewModal) {
                    viewModal.classList.add('hidden');
                    viewModal.classList.remove('flex');
                }
            });
        });
    </script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewOpsButton = document.querySelectorAll('.viewOps-button');
            const viewOpsModal = document.getElementById('viewOpsModal');
            const closeModal = document.getElementById('closeViewModal');

            viewOpsButton.forEach(button => {
                button.addEventListener('click', function() {
                    const pic = this.getAttribute('data-pic');
                    const name = this.getAttribute('data-name');
                    const operator = this.getAttribute('data-operator');
                    const worked = this.getAttribute('data-worked');
                    const comment = this.getAttribute('data-comment');
                    viewOpsModal.querySelector('img#designReference').src = `/${pic}`;
                    viewOpsModal.querySelector('#requestName').textContent = name;
                    viewOpsModal.querySelector('#operatorName').textContent = operator;
                    viewOpsModal.querySelector('#piecesWorked').textContent = worked;
                    viewOpsModal.querySelector('#comment').textContent = comment;

                    viewOpsModal.classList.remove('hidden');
                    viewOpsModal.classList.add(
                        'flex');
                });
            });

            closeModal.addEventListener('click', function() {
                viewOpsModal.classList.add('hidden');
                viewOpsModal.classList.remove('flex');
            });

            viewOpsModal.addEventListener('click', function(e) {
                if (e.target === viewOpsModal) {
                    viewOpsModal.classList.add('hidden');
                    viewOpsModal.classList.remove('flex');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/menus/location.blade.php ENDPATH**/ ?>