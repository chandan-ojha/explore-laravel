<?php

namespace App\Jobs;

use App\Enums\VaccinationStatus;
use App\Mail\VaccinationScheduleMail;
use App\Models\Center;
use App\Models\Vaccination;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Vaccination $vaccination, public Center $center)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Vaccination::where('email', $this->vaccination->email)
            ->update([
                'status' => VaccinationStatus::SCHEDULED,
                'notification_sent_at' => now(),
            ]);

        $mail = new VaccinationScheduleMail($this->vaccination->name, $this->center);

        Mail::to($this->vaccination->email)->send($mail);
    }
}
