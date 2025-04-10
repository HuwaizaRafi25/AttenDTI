<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\ModelHasPermission;
use Illuminate\Support\Facades\Log;

class RolePermissionController extends Controller
{
    public function index()
    {
        $admin = Role::find('1');
        $user = Role::find('2');
        $alumni = Role::find('3');

        $permissions = Permission::all();

        $permissionNames = [
            'read_user',
            'manage_user',
            'manage_role_permission',
            'read_activity_log',
            'manage_activity_log',
            'read_announcement',
            'manage_announcement',
            'read_attendance',
            'record_attendance',
            'manage_attendance',
            'create_document',
            'read_document',
            'manage_document',
            'read_location',
            'manage_location',
            'read_job',
            'manage_job',
            'manage_dues'
        ];

        $modelHasPermissions = ModelHasPermission::with('user', 'permission')
            ->whereHas('permission', function ($query) use ($permissionNames) {
                $query->whereIn('name', $permissionNames);
            })
            ->get();

        $groupedPermissions = $modelHasPermissions->groupBy(function ($mp) {
            return $mp->permission->name;
        });

        $users = User::all();

        return view('menus.role_permission', compact('groupedPermissions', 'users', 'permissions'));
    }

    public function getPermissions()
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    public function linkUserPermission(Request $request)
    {
        try {
            $user = User::find($request->input('user'));
            $permission = $request->input('permission');
            $user->givePermissionTo($permission);
            // Permission::create([
            //     'model_id' => $user->id,
            //     'permission_id' => $permission
            // ]);

            notify()->success('Model was assigned successfully! 👌');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Failed to assign user permission: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            notify()->error('Something went wrong.', 'Error!');
            return redirect()->back();
        }
    }

    public function unlinkUserPermission(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $permission = $request->permission;
            $user->revokePermissionTo($permission);
            notify()->success('Model was unassigned successfully! 👌');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Failed to unassign user permission: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            notify()->error('Something went wrong.', 'Error!');
            return redirect()->back();
        }
    }
}
