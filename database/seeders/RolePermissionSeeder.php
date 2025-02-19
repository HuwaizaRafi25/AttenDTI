<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);
        $roleAlumni = Role::create(['name' => 'alumni']);

        $permissions = [
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
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roleAdmin = Role::where('name', 'admin')->first();
        $roleAdmin->givePermissionTo($permissions);

        $roleUser = Role::where('name', 'user')->first();
        $roleUser->givePermissionTo([
            'read_user',            // Untuk melihat data diri sendiri
            'read_activity_log',    // Untuk melihat log aktivitas
            'read_announcement',    // Untuk melihat pengumuman
            'read_attendance',      // Untuk rekapan kehadiran
            'record_attendance',    // Untuk merekam kehadiran
            'read_job'              // Untuk melihat lowongan kerja
        ]);

        $roleAlumni = Role::where('name', 'alumni')->first();
        $roleAlumni->givePermissionTo([
            'read_user',            // Untuk melihat data diri sendiri
            'read_activity_log',    // Untuk melihat log aktivitas
            'read_announcement',    // Untuk melihat pengumuman
            'read_job'              // Untuk melihat lowongan kerja
        ]);

        $user = User::find(1);
        $user->assignRole('admin');
        $user2 = User::find(2);
        $user2->assignRole('user');
        $user3 = User::find(3);
        $user3->assignRole('alumni');
        $user4 = User::find(4);
        $user4->assignRole('user');
        $user5 = User::find(5);
        $user5->assignRole('user');
        $user6 = User::find(6);
        $user6->assignRole('user');
        $user7 = User::find(7);
        $user7->assignRole('user');
        $user8 = User::find(8);
        $user8->assignRole('user');
        $user9 = User::find(9);
        $user9->assignRole('user');
        $user10 = User::find(10);
        $user10->assignRole('user');
        $user = User::find(11);
        $user->assignRole('user');


    }
}
