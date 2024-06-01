<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Illuminate\Console\Command;

class PushNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pushNotifications:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push Notifications ';

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
    public function handle()
    {
        $this->info("Push Notifications");
        $notifications = Notification::with('user')->where(['is_delivered'=> 0,'is_failed' => 0])->where_not('to_all', 1)->limit(10)->get();
        foreach($notifications as $notification){
            if(!empty($notification->user->fcm_token)){
                $data = ['title' => $notification->title , 'description' => $notification->message];
                $firebaseresult = sendNotification($notification->user->fcm_token,$data); 
                if($firebaseresult['status']){
                    $notification->is_delivered = 1;
                    $notification->save();
                }else{
                    $notification->is_failed = 1;
                    $notification->failure_reason = $firebaseresult['message'];
                    $notification->save();
                }
            }else{
                $notifications->update(['is_failed' => 1 ,'failure_reason' => 'FCM Token not found']);
            }
        }
      
    }
}
