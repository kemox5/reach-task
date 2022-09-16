<?php

namespace Modules\Ads\Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Modules\Ads\App\Mail\AdReminder;
use Modules\Ads\App\Models\Ad;
use Tests\TestCase;

class scheduledMailTest extends TestCase
{
      use RefreshDatabase;

      public function test_scheduled_reminder_mail()
      {
            Ad::factory(2)->create([
                  'start_date' => Carbon::now()->addDays(2)->format('Y-m-d')
            ]);

            Ad::factory(3)->create([
                  'start_date' => Carbon::now()->addDays(5)->format('Y-m-d')
            ]);

            Mail::fake();
            $this->travelTo(Carbon::tomorrow()->format('Y-m-d') . ' 20:00');
            $this->artisan('schedule:run');
            Mail::assertSent(AdReminder::class, 2);
      }
}
