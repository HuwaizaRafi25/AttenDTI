<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SchoolService
{
    protected $baseUrl = 'https://api-sekolah-indonesia.vercel.app';

    public function getSMKSchools($page = 1, $perPage = 10)
    {
        $response = Http::get("{$this->baseUrl}/sekolah/SMK", [
            'page' => $page,
            'perPage' => $perPage,
        ]);

        if ($response->successful()) {
            return $response->json(); // Pastikan respons di-decode menjadi array
        }

        return [];
    }
}
