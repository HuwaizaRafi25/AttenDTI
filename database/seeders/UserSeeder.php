<?php

namespace Database\Seeders;

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
            'period_start_date' => Carbon::parse('2024-01-02'),
            'period_end_date' => Carbon::parse('2024-04-11'),
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
            'period_start_date' => Carbon::parse('2024-01-02'),
            'period_end_date' => Carbon::parse('2024-04-11'),
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
            'period_start_date' => Carbon::parse('2024-07-02'),
            'period_end_date' => Carbon::parse('2025-01-11'),
            'major' => 'Desain Komunikasi dan Visual',
            'institution' => 'SMK Itikurih',
            'placement_id' => 1,
            'last_seen' => now(),
        ]);

        User::create([
            'identity_number'   => '008556455',
            'username'          => 'andiputra',
            'itb_account'       => 'andiputra@itb.ac.id',
            'email'             => 'andi@gmail.com',
            'phone'             => '08877653346',
            'password'          => Hash::make('andi12345'),
            'full_name'         => 'Andi Putra',
            'gender'            => '1',
            'address'           => 'Jl. Andi No. 2',
            'profile_pic'       => 'andi.jpg',
            'period_start_date' => Carbon::parse('2024-08-01'),
            'period_end_date'   => Carbon::parse('2025-02-15'),
            'major'             => 'Teknik Informatika',
            'institution'       => 'SMK IT',
            'placement_id'      => 2,
            'last_seen'         => now(),
        ]);

        User::create([
            'identity_number'   => '008556456',
            'username'          => 'budiman',
            'itb_account'       => 'budiman@itb.ac.id',
            'email'             => 'budiman@gmail.com',
            'phone'             => '08877653347',
            'password'          => Hash::make('budiman54321'),
            'full_name'         => 'Budiman Setiawan',
            'gender'            => '1',
            'address'           => 'Jl. Budiman No. 3',
            'profile_pic'       => 'budiman.jpg',
            'period_start_date' => Carbon::parse('2024-09-05'),
            'period_end_date'   => Carbon::parse('2025-03-20'),
            'major'             => 'Sistem Informasi',
            'institution'       => 'SMK TI',
            'placement_id'      => 1,
            'last_seen'         => now(),
        ]);

        User::create([
            'identity_number'   => '008556457',
            'username'          => 'charles',
            'itb_account'       => 'charles@itb.ac.id',
            'email'             => 'charles@gmail.com',
            'phone'             => '08877653348',
            'password'          => Hash::make('charles2024'),
            'full_name'         => 'Charles Wijaya',
            'gender'            => '1',
            'address'           => 'Jl. Charles No. 4',
            'profile_pic'       => 'charles.jpg',
            'period_start_date' => Carbon::parse('2024-10-10'),
            'period_end_date'   => Carbon::parse('2025-04-25'),
            'major'             => 'Teknik Elektro',
            'institution'       => 'SMK Elektro',
            'placement_id'      => 1,
            'last_seen'         => now(),
        ]);

        User::create([
            'identity_number'   => '008556458',
            'username'          => 'dedi',
            'itb_account'       => 'dedi@itb.ac.id',
            'email'             => 'dedi@gmail.com',
            'phone'             => '08877653349',
            'password'          => Hash::make('dedi98765'),
            'full_name'         => 'Dedi Santoso',
            'gender'            => '1',
            'address'           => 'Jl. Dedi No. 5',
            'profile_pic'       => 'dedi.jpg',
            'period_start_date' => Carbon::parse('2024-11-15'),
            'period_end_date'   => Carbon::parse('2025-05-30'),
            'major'             => 'Manajemen',
            'institution'       => 'SMK Manajemen',
            'placement_id'      => 1,
            'last_seen'         => now(),
        ]);

        User::create([
            'identity_number'   => '008556459',
            'username'          => 'eko',
            'itb_account'       => 'eko@itb.ac.id',
            'email'             => 'eko@gmail.com',
            'phone'             => '08877653350',
            'password'          => Hash::make('eko54321'),
            'full_name'         => 'Eko Prasetyo',
            'gender'            => '1',
            'address'           => 'Jl. Eko No. 6',
            'profile_pic'       => 'eko.jpg',
            'period_start_date' => Carbon::parse('2024-12-01'),
            'period_end_date'   => Carbon::parse('2025-06-15'),
            'major'             => 'Teknik Mesin',
            'institution'       => 'SMK Mesin',
            'placement_id'      => 2,
            'last_seen'         => now(),
        ]);

        User::create([
            'identity_number'   => '008556460',
            'username'          => 'fajar',
            'itb_account'       => 'fajar@itb.ac.id',
            'email'             => 'fajar@gmail.com',
            'phone'             => '08877653351',
            'password'          => Hash::make('fajar67890'),
            'full_name'         => 'Fajar Nugroho',
            'gender'            => '1',
            'address'           => 'Jl. Fajar No. 7',
            'profile_pic'       => 'fajar.jpg',
            'period_start_date' => Carbon::parse('2025-01-05'),
            'period_end_date'   => Carbon::parse('2025-07-20'),
            'major'             => 'Arsitektur',
            'institution'       => 'SMK Arsitektur',
            'placement_id'      => 2,
            'last_seen'         => now(),
        ]);

        User::create([
            'identity_number'   => '008556461',
            'username'          => 'gilang',
            'itb_account'       => 'gilang@itb.ac.id',
            'email'             => 'gilang@gmail.com',
            'phone'             => '08877653352',
            'password'          => Hash::make('gilangpass'),
            'full_name'         => 'Gilang Pratama',
            'gender'            => '1',
            'address'           => 'Jl. Gilang No. 8',
            'profile_pic'       => 'gilang.jpg',
            'period_start_date' => Carbon::parse('2025-02-10'),
            'period_end_date'   => Carbon::parse('2025-08-15'),
            'major'             => 'Teknik Sipil',
            'institution'       => 'SMK Sipil',
            'placement_id'      => 1,
            'last_seen'         => now(),
        ]);

        User::create([
            'identity_number'   => '008556462',
            'username'          => 'hadi',
            'itb_account'       => 'hadi@itb.ac.id',
            'email'             => 'hadi@gmail.com',
            'phone'             => '08877653353',
            'password'          => Hash::make('hadipass'),
            'full_name'         => 'Hadi Kusuma',
            'gender'            => '1',
            'address'           => 'Jl. Hadi No. 9',
            'profile_pic'       => 'hadi.jpg',
            'period_start_date' => Carbon::parse('2025-03-15'),
            'period_end_date'   => Carbon::parse('2025-09-20'),
            'major'             => 'Teknik Kimia',
            'institution'       => 'SMK Kimia',
            'placement_id'      => 2,
            'last_seen'         => now(),
        ]);

        User::create([
            'identity_number'   => '008556463',
            'username'          => 'irfan',
            'itb_account'       => 'irfan@itb.ac.id',
            'email'             => 'irfan@gmail.com',
            'phone'             => '08877653354',
            'password'          => Hash::make('irfan9876'),
            'full_name'         => 'Irfan Maulana',
            'gender'            => '1',
            'address'           => 'Jl. Irfan No. 10',
            'profile_pic'       => 'irfan.jpg',
            'period_start_date' => Carbon::parse('2025-04-20'),
            'period_end_date'   => Carbon::parse('2025-10-30'),
            'major'             => 'Teknik Industri',
            'institution'       => 'SMK Industri',
            'placement_id'      => 1,
            'last_seen'         => now(),
        ]);

        // create 5 data user random siswa


    }
}
