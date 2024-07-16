<?php

namespace App\Console\Commands;

use App\Models\EmailMailer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending emails for every 10 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    // public function handle()
    // {
    //     Log::info('Sending emails');
    //     $emailmailer = EmailMailer::where(['cron_status'=>'0','is_cron'=>'1'])->limit(20)->get();
    //     foreach($emailmailer as $email){
    //         $mail =Mail::send([], [], function ($message) use ($email)
    //         {
    //             $message->from($email->mail_from, env('MAIL_FROM_NAME'));
    //             $message->to($email->mail_to);
    //             $message->subject($email->mail_subject);
    //             $message->setBody($email->mail_message,'text/html');

    //         });

    //         if(count(Mail::failures()) == 0){
    //             $this->info("success");
    //             $email->cron_status = "1";
    //             $email->save();
    //             Log::info('Email sent successfully');
    //         }else{
    //             $this->info("failure");
    //             $email->cron_status = "2";
    //             $email->save();
    //             Log::info(Mail::failures());
    //             Log::info('Error in Email sending');
    //         }
    //     }


    // }
    public function handle()
    {
        Log::info('Starting email sending process');

        // Fetch emails that need to be sent
        $emailMailer = EmailMailer::where(['cron_status' => '0', 'is_cron' => '1'])->limit(20)->get();

        foreach ($emailMailer as $email) {
            try {
                // Send the email
                $mail = Mail::send([], [], function ($message) use ($email) {
                    $message->from($email->mail_from, env('MAIL_FROM_NAME'));
                    $message->to($email->mail_to);
                    $message->subject($email->mail_subject);
                    $message->setBody($email->mail_message, 'text/html');
                });
                if(count(Mail::failures()) == 0){
                    $this->info("success");
                    $email->cron_status = "1";
                    $email->save();
                    Log::info('Email sent successfully to: ' . $email->mail_to);
                }else{
                    $this->info("failure");
                    $email->cron_status = "2";
                    $email->save();
                    Log::info(Mail::failures());
                    Log::info('Error in Email sending to: ' . $email->mail_to);
                }
            } catch (\Exception $e) {
                // Log the exception and update the email status to failed
                $email->cron_status = "2";
                $email->save();

                Log::error('Failed to send email to: ' . $email->mail_to . '. Error: ' . $e->getMessage());
            }
        }

        Log::info('Email sending process completed');
    }
}
