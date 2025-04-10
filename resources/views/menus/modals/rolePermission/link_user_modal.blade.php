<div id="linkUserPermission" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Link User</h2>
            {{-- <button class="closeLinkUser text-gray-400 hover:text-gray-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                <span class="sr-only">Close</span>
            </button> --}}
        </div>
        <form id="assignPermissionForm" action="{{ route('rolesPermissions.link') }}" class="p-4 space-y-4"
            method="POST">
            @csrf
            <div class="space-y-2">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Select User</label>
                <div class="relative">
                    <select id="user_id" name="user"
                        class="mt-1 border-2 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option selected hidden disabled value="">Select a user</option>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                fetch('/getAllUsers')
                                    .then(response => response.json())
                                    .then(data => {
                                        let dropdown = document.getElementById("user_id");
                                        data.forEach(user => {
                                            let option = document.createElement("option");
                                            option.value = user.id;
                                            option.textContent = `${user.itb_account} - ${user.full_name}`;
                                            dropdown.appendChild(option);
                                        });
                                    })
                                    .catch(error => console.error('Error:', error));
                            });
                        </script>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label for="permission_id" class="block text-sm font-medium text-gray-700">Select Permission</label>
                <div class="relative">
                    <select id="permission_id" name="permission"
                        class="mt-1 border-2 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Select a permission</option>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                fetch('/getPermissions')
                                    .then(response => response.json())
                                    .then(data => {
                                        let dropdown = document.getElementById("permission_id");
                                        data.forEach(permissions => {
                                            let option = document.createElement("option");
                                            option.value = permissions.name;
                                            option.textContent = `${permissions.name}`;
                                            dropdown.appendChild(option);
                                        });
                                    })
                                    .catch(error => console.error('Error:', error));
                            });
                        </script>
                    </select>
                </div>
            </div>
        </form>
        <div class="flex justify-end space-x-3 px-4 py-3 bg-gray-50">
            <button
                class="closeLinkUser px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </button>
            <button onclick="submitAssignPermission()"
                class="inline-flex items-center gap-x-1 px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fa-solid fa-link"></i> Assign Permission
            </button>
        </div>
    </div>
</div>

<script>
    function closeLinkModal() {
        document.getElementById('linkUserPermission').classList.add('hidden');
    }

    // Pastikan variabel form sesuai dengan id form yang ada
    let assignPermissionForm = document.getElementById('assignPermissionForm');

    function submitAssignPermission() {
        const userId = document.getElementById('user_id').value;
        const permissionId = document.getElementById('permission_id').value;

        if (!userId || !permissionId) {
            alert('Please select both a user and a permission');
            return;
        }

        closeLinkModal();
        assignPermissionForm.submit();
    }
</script>
