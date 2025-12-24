<?php $__env->startSection('content'); ?>
    <?php if(Auth::user()->hasRole('admin') || Auth::user()->can('manage_attendance')): ?>
        <style>
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

        <div class="">
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between w-full items-center mb-2">
                        <div class="flex flex-col sm:flex-row justify-between gap-y-2 items-start mb-4">
                            <img src="<?php echo e(asset('assets/images/icons/more.svg')); ?>"
                                class="w-4 opacity-75 block ml-4 md:hidden cursor-pointer" alt="moreButton" id="moreButton">
                            <h3 class="text-xl font-semibold mb-2 ml-4 hidden lg:block">Attendance Management</h3>
                            <div id="optionsMenu"
                                class="hidden md:relative md:flex md:flex-row md:space-y-0 md:space-x-4 bg-white md:bg-transparent p-3 md:p-0 rounded-md md:rounded-none shadow-xl md:border-none border-t-2 md:shadow-none items-center space-y-2 mt-3 md:mt-0 ml-4 !relative"
                                style="">
                                <div class="relative">
                                    <button id="sortButton"
                                        onclick="document.getElementById('sortDropdown').classList.toggle('hidden')"
                                        class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                        <span class="icon mr-1"><?php echo file_get_contents(public_path('assets/images/icons/sort.svg')); ?></span>
                                        <span>Sort</span>
                                    </button>

                                    <div id="sortDropdown"
                                        class="hidden fixed md:ml-0 ml-[116px] md:mt-2 -mt-6 w-48 bg-white border-t rounded-md shadow-lg z-10">
                                        <div class="py-1">
                                            <a href="#" onclick="applySort('full_name', 'asc')"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Full Name
                                                (A-Z)</a>
                                            <a href="#" onclick="applySort('full_name', 'desc')"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Full Name
                                                (Z-A)</a>
                                            <a href="#" onclick="applySort('institution', 'asc')"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Institution
                                                (A-Z)</a>
                                            <a href="#" onclick="applySort('institution', 'desc')"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Institution
                                                (Z-A)</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-px h-6 bg-gray-300 hidden"></div>

                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                        <span class="icon mr-1"><?php echo file_get_contents(public_path('assets/images/icons/export.svg')); ?></span>
                                        <span>Export/Import</span>
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false"
                                        class="fixed -mt-6 md:mt-2 md:ml-0 ml-[116px] w-48 bg-white border-t rounded-md shadow-lg z-10">
                                        <div class="py-1">
                                            <a href="<?php echo e(route('users.export', ['type' => 'pdf']) . '?' . http_build_query(request()->query())); ?>"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor
                                                as
                                                <b>PDF</b></a>
                                            <a href="<?php echo e(route('users.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query())); ?>"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor
                                                as
                                                <b>Excel</b></a>
                                            <a href="<?php echo e(route('users.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query())); ?>"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor
                                                as
                                                <b>CSV</b></a>
                                            <a id="importButton"
                                                class="importButton block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">Import
                                                <b>Data</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Print Button -->
                                
                                <button id="printUserButton"
                                    class="flex items-center text-gray-700 hover:text-green-600 transition duration-200">
                                    <span class="icon mr-1"><?php echo file_get_contents(public_path('assets/images/icons/printer.svg')); ?></span>
                                    <span>Print</span>
                                </button>

                                <div class="h-5 w-0.5 border border-gray-700"></div>

                                
                                <!-- Month and Year Selectors -->
                                <div class="flex items-center gap-2">
                                    <!-- Month Selector -->
                                    <div class="relative" id="monthSelector">
                                        <button id="monthButton"
                                            class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200 bg-white border border-gray-200 rounded-md px-3 py-1.5">
                                            <span class="icon mr-1"><?php echo file_get_contents(public_path('assets/images/icons/calendar.svg')); ?></span>
                                            <?php
                                                $selectedMonthNumber = request()->get('month');
                                                $selectedMonthName = $selectedMonthNumber
                                                    ? \Carbon\Carbon::create()->month($selectedMonthNumber)->format('F')
                                                    : date('F');
                                            ?>

                                            <span id="selectedMonth">
                                                <?php echo e($selectedMonthName); ?>

                                            </span>

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div id="monthDropdown"
                                            class="absolute mt-1 w-40 bg-white border rounded-md shadow-lg z-10 hidden">
                                            <div class="py-1 max-h-60 overflow-y-auto">
                                                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $monthNumber = \Carbon\Carbon::parse($month)->format('m'); // 1 - 12
                                                    ?>
                                                    <button data-month="<?php echo e($monthNumber); ?>"
                                                        data-monthText="<?php echo e($month); ?>"
                                                        @click.prevent="toggleFilter('month', '<?php echo e($monthNumber); ?>')"
                                                        class="month-option block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 <?php echo e($month === $selectedMonthName ? 'bg-blue-50 text-blue-600 font-medium' : ''); ?>">
                                                        <?php echo e($month); ?>

                                                    </button>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </div>
                                        </div>
                                        <input type="hidden" name="month" id="monthInput" value="<?php echo e(date('F')); ?>">
                                    </div>

                                    <!-- Year Selector -->
                                    <div class="relative" id="yearSelector">
                                        <button id="yearButton"
                                            class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200 bg-white border border-gray-200 rounded-md px-3 py-1.5">
                                            <?php
                                                $selectedYear = request()->get('year');
                                                $selectedYear = $selectedYear ? $selectedYear : date('Y');
                                            ?>
                                            <span id="selectedYear"><?php echo e($selectedYear); ?></span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div id="yearDropdown"
                                            class="absolute mt-1 w-32 bg-white border rounded-md shadow-lg z-10 hidden">
                                            <div class="py-1 max-h-60 overflow-y-auto">
                                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <button data-year="<?php echo e($year); ?>"
                                                        data-yearText="<?php echo e($year); ?>"
                                                        @click.prevent="toggleFilter('year', '<?php echo e($year); ?>')"
                                                        class="year-option block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 <?php echo e($year == $selectedYear ? 'bg-blue-50 text-blue-600 font-medium' : ''); ?>">
                                                        <?php echo e($year); ?>

                                                    </button>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="year" id="yearInput"
                                            value="<?php echo e(date('Y')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <!-- Search Bar -->
                            <div class="relative inline-block h-12 w-12 -mr-6">
                                <input 
                                    class="-mr-3 search expandright absolute right-[49px] rounded bg-white border border-white h-8 w-0 lg:focus:w-[190px] md:focus:w-[164px] focus:w-[148px]  transition-all duration-400 outline-none z-10 focus:px-4 focus:border-blue-500"
                                    id="searchright" value="<?php echo e($search ? $search : null); ?>" type="text"
                                    name="q" placeholder="Cari">
                                <label class="z-20 button searchbutton absolute text-[22px] w-full cursor-pointer"
                                    for="searchright">
                                    <span class="-ml-3 mt-1 inline-block">
                                        <span class="icon ">
                                            <?php echo file_get_contents(public_path('assets/images/icons/search.svg')); ?>

                                        </span>
                                    </span>
                                </label>
                            </div>
                            <button
                                class="attendUser-button -mt-1 max-h-10 flex items-center bg-[#187bcd] text-white font-semibold px-4 text-sm rounded hover:bg-[#4f57a5] transition duration-200">
                                <span class="icon mr-2 scale-150">
                                    <?php echo file_get_contents(public_path('assets/images/icons/plus.svg')); ?>

                                </span>
                                Attend User
                            </button>
                        </div>
                    </div>
                    <div id="attendance-table" class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="attendanceTable">
                            <thead class="bg-gray-100 sticky top-0">
                                <tr class="text-gray-600 uppercase text-xs font-medium">
                                    <th class="px-4 py-3 text-center">No</th>
                                    <th class="px-4 py-3 text-center">NISN</th>
                                    <th class="px-4 py-3 text-center">Name</th>
                                    <th class="px-4 py-3 text-center">Institution</th>

                                    <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th
                                            class="px-4 py-3 text-center
                                            <?php echo e(\Carbon\Carbon::parse($date)->isToday() ? 'text-blue-800 text-lg' : ''); ?>

                                            <?php echo e(\Carbon\Carbon::parse($date)->isWeekend() ? 'text-gray-600' : ''); ?>

                                            <?php echo e(in_array(\Carbon\Carbon::parse($date)->format('Y-m-d'), $holidays) ? 'text-red-600' : ''); ?>

                                            <?php echo e(!\Carbon\Carbon::parse($date)->isToday() && !\Carbon\Carbon::parse($date)->isWeekend() ? 'text-gray-800' : ''); ?>">
                                            <?php echo e(\Carbon\Carbon::parse($date)->translatedFormat('d')); ?>

                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <th class="px-4 py-3 text-center">Present</th>
                                    <th class="px-4 py-3 text-center">Total Days</th>
                                    <th class="px-4 py-3 text-center">Attendance</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-600">
                                <?php echo $__env->make('menus.tables.attendance_table', ['users' => $users], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="hidden" id="userReportTable">
                        <div class="mb-6">
                            <p>
                                <strong>Waktu Laporan:</strong>
                                
                                Semua waktu
                                
                            </p>
                            <p><strong>Disusun Oleh:</strong> Admin Wasuhin</p>
                        </div>

                        
                        <div class="mt-10 flex flex-col items-end w-full h-min justify-end">
                            <div class="text-right flex gap-x-1">
                                <p class="text-base text-gray-800">Admin</p>
                                <p class="text-base text-gray-800">DTI ITB,</p>
                            </div>

                            <div class="mt-10 text-right">
                                <p class="text-md font-medium text-gray-700"><?php echo e(Auth::user()->full_name); ?></p>
                                <div class="border-b border-gray-400 w-32 mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
        <script>
            const printCssPath = "<?php echo e(asset('assets/css/app.css')); ?>";
        </script>
        <script>
            document.getElementById("moreButton").addEventListener("click", function() {
                var optionsMenu = document.getElementById("optionsMenu");
                optionsMenu.classList.toggle("show");
            });

            window.addEventListener("resize", function() {
                var optionsMenu = document.getElementById("optionsMenu");
                if (optionsMenu.classList.contains("show")) {
                    optionsMenu.classList.remove("show");
                }
            });
        </script>
        <script src="<?php echo e(asset('assets/js/attendance.js')); ?>"></script>
    <?php else: ?>
        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.2s ease-out forwards;
                opacity: 0;
            }

            /* Ensure the modal has a nice transition */
            #absentModal {
                transition: opacity 0.2s ease-out;
            }

            /* Smooth transitions for the placement container */
            #placementContainer {
                transition: opacity 0.3s ease-out;
            }
        </style>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-8">
                <div class="flex flex-col gap-4 md:flex-row items-center justify-between mb-8">
                    <?php if(in_array(today()->format('Y-m-d'), $holidays)): ?>
                        <!-- Jika hari ini adalah hari libur -->
                        <div class="text-center md:text-left mb-6 md:mb-0">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Good Morning, <?php echo e(Auth::user()->full_name); ?>!</h2>
                            <p class="text-lg text-gray-600">Today is a holiday! Enjoy your day off!</p>
                        </div>
                    <?php elseif(Carbon\Carbon::now()->isWeekday()): ?>
                        <!-- Jika hari ini adalah hari kerja -->
                        <?php if(Auth::user()->attendances->where('created_at', '>=', today()->startOfDay())->where('created_at', '<=', today()->endOfDay())->count() > 0): ?>
                            <!-- Jika pengguna sudah melakukan attendance hari ini -->
                            <div class="text-center md:text-left mb-6 md:mb-0">
                                <h2 class="text-3xl font-bold text-gray-800 mb-2">Good Morning, <?php echo e(Auth::user()->full_name); ?>!</h2>
                                <p class="text-lg text-gray-600">You've marked your presence today. Keep up the good work!</p>
                            </div>
                        <?php else: ?>
                            <!-- Jika pengguna belum melakukan attendance hari ini -->
                            <?php if(Carbon\Carbon::now() >= $lateTime): ?>
                                <!-- Jika waktu saat ini sudah melewati lateTime -->
                                <div class="text-center md:text-left mb-6 md:mb-0">
                                    <h2 class="text-3xl font-bold text-gray-800 mb-2">You're late!</h2>
                                    <p class="text-lg text-gray-600">Please fill out the form to explain your lateness.</p>
                                </div>
                                <div class="flex gap-x-4">
                                    <button onclick="window.location.href='<?php echo e(route('attendance.form', Auth::id()). '&type=late'); ?>'"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                        <i class="fas fa-file-alt mr-2"></i> Fill Late Form
                                    </button>
                                </div>
                            <?php else: ?>
                                <!-- Jika waktu saat ini belum melewati lateTime -->
                                <div class="text-center md:text-left mb-6 md:mb-0">
                                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Hello! Ready to start your day?</h2>
                                    <p class="text-lg text-gray-600">Let's mark your presence and make today count!</p>
                                </div>
                                <div class="flex gap-x-4">
                                    <button onclick="window.location.href='<?php echo e(route('attendance.request', Auth::id())); ?>'"
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                        <i class="fas fa-check-circle mr-2"></i> I'm Here!
                                    </button>
                                    <button onclick="showAbsentModal()"
                                        class="absentButton bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                        <i class="fas fa-times-circle mr-2"></i> Not Today
                                    </button>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Attendance Summary</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-blue-100 p-6 rounded-xl hover-lift shadow-md">
                        <div class="flex items-start justify-between text-blue-500 gap-x-2 mb-2">
                            <i class="fas fa-user-check text-4xl mb-3"></i>
                            <i class="fas fa-circle-info text-lg opacity-60 hover:opacity-90 -mt-2 -mr-2"></i>
                        </div>
                        <p class="text-5xl font-bold text-blue-600 mb-1">18</p>
                        <p class="font-medium text-xl text-gray-600">Present</p>
                    </div>
                    <div class="bg-green-100 p-6 rounded-xl hover-lift shadow-md">
                        <div class="flex items-start justify-between text-green-500 gap-x-2 mb-2">
                            <i class="fas fa-clock text-4xl mb-3"></i>
                            <i class="fas fa-circle-info text-lg opacity-60 hover:opacity-90 -mt-2 -mr-2"></i>
                        </div>
                        <p class="text-5xl font-bold text-green-600 mb-1">16</p>
                        <p class="font-medium text-xl text-gray-600">On Time</p>
                    </div>
                    <div class="bg-yellow-100 p-6 rounded-xl hover-lift shadow-md">
                        <div class="flex items-start justify-between text-yellow-500 gap-x-2 mb-2">
                            <i class="fas fa-hourglass-half text-4xl mb-3"></i>
                            <i class="fas fa-circle-info text-lg opacity-60 hover:opacity-90 -mt-2 -mr-2"></i>
                        </div>
                        <p class="text-5xl font-bold text-yellow-600 mb-1">2</p>
                        <p class="font-medium text-xl text-gray-600">Late</p>
                    </div>
                    <div class="bg-red-100 p-6 rounded-xl hover-lift shadow-md">
                        <div class="flex items-start justify-between text-red-500 gap-x-2 mb-2">
                            <i class="fas fa-user-times text-4xl mb-3"></i>
                            <i class="fas fa-circle-info text-lg opacity-60 hover:opacity-90 -mt-2 -mr-2"></i>
                        </div>
                        <p class="text-5xl font-bold text-red-600 mb-1">10</p>
                        <p class="font-medium text-xl text-gray-600">Absent</p>
                    </div>
                </div>
            </div>

            <div class="col-span-1 bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Current Time</h2>
                <div class="flex flex-col items-center">
                    <svg class="w-64 h-64 mb-6" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="48" fill="none" stroke="#E5E7EB"
                            stroke-width="2" />
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#CBD5E0"
                            stroke-width="2" />
                        <!-- Clock numbers -->
                        <text x="50" y="18" text-anchor="middle" font-size="8" class="font-bold"
                            fill="#4B5563">12</text>
                        <text x="88" y="53" text-anchor="middle" font-size="8" class="font-bold"
                            fill="#4B5563">3</text>
                        <text x="50" y="88" text-anchor="middle" font-size="8" class="font-bold"
                            fill="#4B5563">6</text>
                        <text x="14" y="53" text-anchor="middle" font-size="8" class="font-bold"
                            fill="#4B5563">9</text>
                        <!-- Clock hands -->
                        <circle cx="50" cy="50" r="3" fill="#1F2937" />
                        <line id="hourHand" class="clock-hand" x1="50" y1="50" x2="50"
                            y2="30" stroke-linecap="round" />
                        <line id="minuteHand" class="clock-hand" x1="50" y1="50" x2="50"
                            y2="25" stroke-linecap="round" />
                        <line id="secondHand" class="clock-hand" x1="50" y1="50" x2="50"
                            y2="20" stroke-linecap="round" />
                    </svg>
                    <p class="text-4xl font-bold text-blue-600 mb-2" id="currentTime"></p>
                    <p class="text-lg text-gray-600" id="currentDate"></p>
                </div>
            </div>
        </div>
        <?php echo $__env->make('menus.modals.attendance.absent_attendance_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script src="<?php echo e(asset('assets/js/clock.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/userAttendance.js')); ?>"></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/menus/attendance.blade.php ENDPATH**/ ?>