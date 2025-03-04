<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jobs;
use Carbon\Carbon;

class UpdateJobStatus extends Command
{
    protected $signature = 'jobs:update-status';
    protected $description = 'Update status is_active menjadi false jika end_date sudah lewat';

    public function handle()
    {
        $now = Carbon::now();

        $affectedRows = Jobs::where('is_active', true)
            ->where('end_date', '<', $now)
            ->update(['is_active' => 0]);

        $this->info("Berhasil mengupdate {$affectedRows} job(s).");
    }
}
