<?php

namespace App\Jobs;

use App\Enums\VaccinationStatus;
use App\Models\Center;
use App\Models\Vaccination;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ScheduleVaccination implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $allVaccineCenter = Center::all();

        foreach ($allVaccineCenter as $center) {
            $dailyLimit = $center->limit;

            $notVaccinatedUsers = Vaccination::with('center')
                ->where('center_id', '=', $center->id)
                ->where('status', VaccinationStatus::NOT_VACCINATED)
                ->orderBy('id')
                ->limit($dailyLimit)
                ->get();

            foreach ($notVaccinatedUsers as $user) {
                $email = $user->email;
                $vaccineCenter = $user->center->name;

                Vaccination::where('email', $email)
                    ->update([
                        'status' => VaccinationStatus::SCHEDULED,
                        'notification_sent_at' => now(),
                    ]);

                $mail = new VaccinationScheduleMail($user->name, $vaccineCenter);

                Mail::to($email)->send($mail);
            }
        }
    }
}
