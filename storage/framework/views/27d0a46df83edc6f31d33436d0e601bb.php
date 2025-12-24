<?php $__env->startSection('content'); ?>
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
                        <h3 class="text-xl font-semibold mb-2 ml-4 hidden lg:block">Activity</h3>
                        <div id="optionsMenu"
                            class="hidden md:relative md:flex md:flex-row md:space-y-0 md:space-x-4 bg-white md:bg-transparent p-3 md:p-0 rounded-md md:rounded-none shadow-xl md:border-none border-t-2 md:shadow-none items-center space-y-2 mt-3 md:mt-0 ml-4 !relative"
                            style="">
                            <div class="relative" x-data="{
                                open: false,
                                filters: { role: getURLParam('role'), status: getURLParam('status') },
                                toggleFilter(type, value) {
                                    let currentUrl = new URL(window.location.href);
                                    let currentValue = currentUrl.searchParams.get(type);
                                    if (currentValue === value) {
                                        currentUrl.searchParams.delete(type);
                                    } else {
                                        currentUrl.searchParams.set(type, value);
                                    }
                                    window.location.href = currentUrl.toString();
                                }
                            }">
                                <button @click="open = !open"
                                    class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                    <span class="icon mr-1"><?php echo file_get_contents(public_path('assets/images/icons/filter.svg')); ?></span>
                                    <span>Filter</span>
                                </button>

                                <div x-show="open" x-cloak @click.away="open = false"
                                    class="fixed -mt-6 md:mt-2 w-48 md:ml-0 ml-[116px] bg-white border-t rounded-md shadow-lg z-50">
                                    <div class="py-1">
                                        <a href="#" :class="{ 'bg-blue-100': filters.role === 'all' }"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="toggleFilter('role', 'all')">All</a>
                                        <a href="#" :class="{ 'bg-blue-100': filters.role === 'admin' }"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="toggleFilter('role', 'admin')">Admin</a>
                                        <a href="#" :class="{ 'bg-blue-100': filters.role === 'alumni' }"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="toggleFilter('role', 'alumni')">Alumni</a>
                                        <a href="#" :class="{ 'bg-blue-100': filters.role === 'user' }"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="toggleFilter('role', 'user')">User</a>
                                        <div class="border-t mx-2"></div>
                                        <a href="#" :class="{ 'bg-blue-100': filters.status === '1' }"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="toggleFilter('status', '1')">Online</a>
                                        <a href="#" :class="{ 'bg-blue-100': filters.status === '0' }"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="toggleFilter('status', '0')">Offline</a>
                                    </div>
                                </div>
                            </div>

                            <div class="relative" x-data="{
                                open: false,
                                activeSort: getURLParam('sort'),
                                activeDirection: getURLParam('direction'),
                                applySort(column, direction) {
                                    let currentUrl = new URL(window.location.href);
                                    currentUrl.searchParams.set('sort', column);
                                    currentUrl.searchParams.set('direction', direction);
                                    window.location.href = currentUrl.toString();
                                }
                            }">
                                <button @click="open = !open"
                                    class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                    <span class="icon mr-1"><?php echo file_get_contents(public_path('assets/images/icons/sort.svg')); ?></span>
                                    <span>Sort</span>
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false"
                                    class="fixed md:ml-0 ml-[116px] md:mt-2 -mt-6 w-48 bg-white border-t rounded-md shadow-lg z-10">
                                    <div class="py-1">
                                        <a href="#"
                                            :class="activeSort === 'full_name' && activeDirection === 'asc' ?
                                                'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('full_name', 'asc')">Full Name (A-Z)</a>
                                        <a href="#"
                                            :class="activeSort === 'full_name' && activeDirection === 'desc' ?
                                                'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('full_name', 'desc')">Full Name (Z-A)</a>
                                        <a href="#"
                                            :class="activeSort === 'username' && activeDirection === 'asc' ?
                                                'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('username', 'asc')">Username (A-Z)</a>
                                        <a href="#"
                                            :class="activeSort === 'username' && activeDirection === 'desc' ?
                                                'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('username', 'desc')">Username (Z-A)</a>
                                        <a href="#"
                                            :class="activeSort === 'institution' && activeDirection === 'asc' ?
                                                'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('institution', 'asc')">Institution (A-Z)</a>
                                        <a href="#"
                                            :class="activeSort === 'institution' && activeDirection === 'desc' ?
                                                'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('institution', 'desc')">Institution (Z-A)</a>
                                    </div>
                                </div>
                            </div>

                            <div class="w-px h-6 bg-gray-300 hidden"></div>


                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                    <span class="icon mr-1"><?php echo file_get_contents(public_path('assets/images/icons/export.svg')); ?></span>
                                    <span>Export</span>
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false"
                                    class="fixed -mt-6 md:mt-2 md:ml-0 ml-[116px] w-48 bg-white border-t rounded-md shadow-lg z-10">
                                    <div class="py-1">
                                        <a href=""
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai
                                            <b>PDF</b></a>
                                        <a href=""
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai
                                            <b>Excel</b></a>
                                        <a href=""
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai
                                            <b>CSV</b></a>
                                        <a href=""
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai
                                            <b>JSON</b></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Print Button -->
                            
                            <button id="printUserButton"
                                class="flex items-center text-gray-700 hover:text-green-600 transition duration-200">
                                <span class="icon mr-1"><?php echo file_get_contents(public_path('assets/images/icons/printer.svg')); ?></span>
                                <span>Print</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex">
                        <!-- Search Bar -->
                        <div class="relative inline-block h-12 w-12 -mr-6">
                            <input 
                                class="-mr-3 search expandright absolute right-[49px] rounded bg-white border border-white h-8 w-0 lg:focus:w-[190px] md:focus:w-[164px] focus:w-[148px]  transition-all duration-400 outline-none z-10 focus:px-4 focus:border-blue-500"
                                id="searchright" type="text" name="q" placeholder="Cari">
                            <label class="z-20 button searchbutton absolute text-[22px] w-full cursor-pointer"
                                for="searchright">
                                <span class="-ml-3 mt-1 inline-block">
                                    <span class="icon ">
                                        <?php echo file_get_contents(public_path('assets/images/icons/search.svg')); ?>

                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="user-table">
                    <table class="min-w-full table-auto" id="userTable">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 pl-6 text-left">TIMESTAMP</th>
                                <th class="py-3 pl-3 text-left">USER</th>
                                <th class="py-3 pl-3 text-center ">ACTION</th>
                                
                                <th class="py-3 px-3 text-left">DESCRIPTION</th>
                                
                            </tr>
                        </thead>
                        <tbody id="content" class="text-gray-600 text-sm font-light">
                            <?php echo $__env->make('menus.tables.activity_log_table', ['logs' => $logs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </tbody>
                    </table>
                </div>
                <div id="pagination-container" class="mt-4">
                    <?php echo e($logs->links()); ?>

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
    <script src="<?php echo e(asset('assets/js/user.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/menus/activity_log.blade.php ENDPATH**/ ?>