<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;

class ProcessItems implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $total = 100;

        for ($i = 1; $i <= $total; $i++) {

            sleep(1); // محاكاة عملية ثقيلة

            $progress = ($i / $total) * 100;

            Cache::put('progress', $progress);
        }

        Cache::put('progress', 100);
    }
}
