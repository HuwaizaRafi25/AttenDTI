<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class HolidayService
{
    public static function getHolidays($year)
    {
        $apiKey = '32f8d6cd-6e32-4ff3-9d67-1d05a421a117';
        $response = Http::get("https://holidayapi.com/v1/holidays", [
            'key' => $apiKey,
            'country' => 'ID',
            'year' => $year,
        ]);

        if ($response->successful()) {
            return $response->json()['holidays'];
        }


        return [];
    }
}
