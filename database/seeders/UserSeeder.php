<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::truncate();
        // Location::truncate();

        AppSetting::create([
            'app_name' => 'AttenDTI',
            'app_logo' => 'logo.png',
            'late_time' => Carbon::parse('08:00:00'),
        ]);

        Location::create([
            'name' => 'CRCS',
            'campus' => 'ITB Kampus Ganesha',
            'address' => 'Jl. Ganesha No. 10',
            'email_address' => 'crcs@itb.ac.id',
            'latitude' => -6.887633,
            'longitude' => 107.611791,
            'radius' => 25,
            'pic' => 'CRCS-2018.jpg',
        ]);

        Location::create([
            'name' => 'Labtek I',
            'campus' => 'ITB Kampus Ganesha',
            'address' => 'Jl. G ITB',
            'email_address' => 'labtekI@gmail.com',
            'latitude' => -6.889032,
            'longitude' => 107.611147,
            'radius' => 25,
            'pic' => 'LABTEK.jpg',
        ]);


        User::create([
            'identity_number' => null,
            'username' => 'paakew',
            'itb_account' => 'paakew@itb.ac.id',
            'email' => 'paakew@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('dtikerenaslina'),
            'full_name' => 'Iwan Setiawan',
            'gender' => '1',
            'address' => 'Jl. Admin No. 1',
            'profile_pic' => 'alkhawarizmi.jpg',
            'period_start_date' => null,
            'period_end_date' => null,
            'major' => null,
            'institution' => null,
            'placement_id' => null,
            'last_seen' => now(),
        ]);

        // Membuat user biasa
        User::create([
            'identity_number' => '0987654321',
            'username' => 'huwaizarafi25',
            'itb_account' => 'huwaiza.r@itb.ac.id',
            'email' => 'huwaiza137@gmail.com',
            'phone' => '08815184624',
            'password' => Hash::make('sayadaricisaat'),
            'full_name' => 'Muhammad Huwaiza Rafi',
            'gender' => '1',
            'address' => 'Jl. Student No. 2',
            'profile_pic' => 'A9DwuCrB5YxU6mhIq0IjK8hPKRsBi6NsY1VrMr9S.jpg',
            'period_start_date' => Carbon::parse('2025-01-02'),
            'period_end_date' => Carbon::parse('2025-04-12'),
            'major' => 'Rekayasa Perangkat Lunak',
            'institution' => 'SMK TI Pembangunan Cimahi',
            'placement_id' => 1,
            'last_seen' => now(),
        ]);

        User::create([
            'identity_number' => '1234567890',
            'username' => 'akmalmaulana',
            'itb_account' => 'akmal.ma@itb.ac.id',
            'email' => 'akmalmaulana@gmail.com',
            'phone' => '0884456654',
            'password' => Hash::make('akmalanaksoleh'),
            'full_name' => 'Akmal Maulana',
            'gender' => '1',
            'address' => 'Jl. Student No. 3',
            'profile_pic' => 'aQQ3fBEi0iDY97mN7ITKtE8KU7gZgXPfVKGtwje1.jpg',
            'period_start_date' => Carbon::parse('2024-11-02'),
            'period_end_date' => Carbon::parse('2025-01-11'),
            'major' => 'Teknik Komputer dan Jaringan',
            'institution' => 'SMK TI Pembangunan Cimahi',
            'placement_id' => 2,
            'last_seen' => now(),
        ]);

        User::create([
            'identity_number' => '008556454',
            'username' => 'imamajah',
            'itb_account' => 'mamsajah@itb.ac.id',
            'email' => 'imams@gmail.com',
            'phone' => '08877653345',
            'password' => Hash::make('imamdarisoreang'),
            'full_name' => 'Imam Ajah',
            'gender' => '1',
            'address' => 'Jl. Imam No. 1',
            'profile_pic' => 'hengker.jpg',
            'period_start_date' => Carbon::parse('2024-11-02'),
            'period_end_date' => Carbon::parse('2025-01-11'),
            'major' => 'Desain Komunikasi dan Visual',
            'institution' => 'SMK TI Pembangunan Cimahi',
            'placement_id' => 1,
            'last_seen' => now(),
        ]);

        User::create([
            'identity_number' => '008556455',
            'username' => 'aldianye',
            'itb_account' => 'aldian.ye@itb.ac.id',
            'email' => 'andi@gmail.com',
            'phone' => '08877653346',
            'password' => Hash::make('aldianajah'),
            'full_name' => 'Aldian Yusuf Erlambang',
            'gender' => '1',
            'address' => 'Leuwigajah, Cimahi Selatan, Jawa barat',
            'profile_pic' => '67dbbfa372c53.jpg',
            'period_start_date' => Carbon::parse('2025-01-02'),
            'period_end_date' => Carbon::parse('2025-04-12'),
            'major' => 'Teknik Komputer dan Jaringan',
            'institution' => 'SMK TI Pembangunan Cimahi',
            'placement_id' => 2,
            'last_seen' => now(),
        ]);

        User::create([
            'identity_number' => '008556456',
            'username' => 'fauzieputra',
            'itb_account' => 'fauzi.ep@itb.ac.id',
            'email' => 'fauzzii@gmail.com',
            'phone' => '08877653347',
            'password' => Hash::make('ujiajahh'),
            'full_name' => 'Fauzi Eka Putra',
            'gender' => '1',
            'address' => 'Jl. Cibogo Permai',
            'profile_pic' => null,
            'period_start_date' => Carbon::parse('2025-01-02'),
            'period_end_date' => Carbon::parse('2025-04-12'),
            'major' => 'Pengembangan Perangkat Lunak dan Gim',
            'institution' => 'SMK TI Pembangunan Cimahi',
            'placement_id' => 1,
            'last_seen' => now(),
        ]);

        User::create([
            'identity_number' => '00758657',
            'username' => 'irfan',
            'itb_account' => 'irfaan@itb.ac.id',
            'email' => 'irfan@gmail.com',
            'phone' => '0885675665',
            'password' => Hash::make('ipanipan'),
            'full_name' => 'Irfan',
            'gender' => '1',
            'address' => 'Jl. Cibogo Permai',
            'profile_pic' => null,
            'period_start_date' => Carbon::parse('2024-11-02'),
            'period_end_date' => Carbon::parse('2025-02-12'),
            'major' => 'Teknik Komputer dan Jaringan',
            'institution' => 'SMK TI Pembangunan Cimahi',
            'placement_id' => 1,
            'last_seen' => now(),
        ]);
    }
}
