<?php

namespace App\Console\Commands;

use App\Mail\BirthdayEmail;
use App\Models\Guest;
use App\Models\Newsletter;
use App\Models\Statistics;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendBirthdayGreetings extends Command
{
    protected $signature = 'birthday:greeting';

    protected $description = 'Send birthday greetings to users 7 days in advance';

    public function handle()
    {
        $newsletter = Newsletter::latest()->first();
        if ($newsletter->is_active) {
            $guests = Guest::whereMonth('birthday', now()->addDays(7)->month)
                ->whereDay('birthday', now()->addDays(7)->day)
                ->get();

            foreach ($guests as $guest) {
                try {
                    DB::beginTransaction();

                    Mail::to($guest->email)->send(new BirthdayEmail($guest, $newsletter));

                    Statistics::create(['title' => $newsletter->title, 'email' => $guest->email, 'delivered' => true]);

                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollback();

                    Statistics::create(['title' => $newsletter->title, 'email' => $guest->email, 'delivered' => false]);
                }
            }
            $this->info('Birthday greetings sent successfully');
        }
    }
}
