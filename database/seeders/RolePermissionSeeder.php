<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
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
        $roleAlumnus = Role::create(['name' => 'alumnus']);
        
        User::create([
            'nisn' => '008556454',
            'username' => 'imamajah',
            'itb_account' => 'mamsajah@itb.ac.id',
            'email' => 'imams@gmail.com',
            'phone' => '08877653345',
            'password' => Hash::make('imamdarisoreang'),
            'full_name' => 'Imam Ajah',
            'address' => 'Jl. Imam No. 1',
            'profile_pic' => 'foto_imam.jpg',
            'period_start_date' => Carbon::parse('2024-07-02'),
            'period_end_date' => Carbon::parse('2025-01-11'),
            'school' => 'SMK Itikurih',
            'placement_id' => 1,
            'last_seen' => now(),
        ]);

        $user = User::find(1);
        $user->assignRole('admin');
        $user2 = User::find(2);
        $user2->assignRole('user');
        $user3 = User::find(3);
        $user3->assignRole('alumnus');
        $user4 = User::find(4);
        $user4->assignRole('user');
    }
}
