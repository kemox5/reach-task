<?php

namespace Modules\Ads\App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Modules\Ads\App\Mail\AdReminder;
use Modules\Ads\App\Models\Ad;

class SendReminderMailToAdvertisers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Ad::where('start_date', Carbon::tomorrow()->format('Y-m-d'))
            ->join('advertisers', 'advertisers.id', 'ads.advertiser_id')
            ->groupBy('advertisers.id')
            ->select(['advertisers.email'])
            ->get()
            ->pluck('email')
            ->each(function ($email) {
                Mail::to($email)->send(new AdReminder());
            });
    }
}
