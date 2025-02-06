<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExcelExport implements FromCollection, WithHeadings
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Mengambil data yang sudah difilter.
     */
    public function collection()
    {
        return $this->users->map(function ($user, $index) {
            return [
                'No' => $index + 1,
                'Nomor Identitas' => $user->identity_number,
                'Nama Lengkap' => $user->full_name,
                'Akun ITB' => $user->itb_account,
                'Email' => $user->email,
                'No. Telepon' => $user->phone,
                'Jenis Kelamin' => $user->gender,
                'Alamat' => $user->address,
                'Tanggal Mulai Praktik Kerja Lapangan' => $user->period_start_date,
                'Tanggal Selesai Praktik Kerja Lapangan' => $user->period_end_date,
                'Jurusan' => $user->major,
                'Instansi' => $user->institution,
                'Lokasi Penempatan' => $user->placement ? $user->placement->name : '-',
            ];
        });
    }

    /**
     * Mengatur header kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'No',
            'Nomor Identitas',
            'Nama Lengkap',
            'Akun ITB',
            'Email',
            'No. Telepon',
            'Jenis Kelamin',
            'Alamat',
            'Tanggal Mulai Praktik Kerja Lapangan',
            'Tanggal Selesai Praktik Kerja Lapangan',
            'Jurusan',
            'Instansi',
            'Lokasi Penempatan',
        ];
    }
}
