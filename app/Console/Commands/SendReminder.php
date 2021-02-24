<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;


class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends mail to clients without profile images to submit their images at the 
    company';

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
        $contacts = Client::where('profile_image','default-avatar.png')->get();//Finds clients without profile images
        
        foreach($contacts as $contact){ 
          Mail::raw('Dear ' .$contact->lastname.', please submit your passport at the office
          to complete your profile', function($message) use ($contact){
              $message->from('profiller@lawfirmx.com.com');
              $message->to($contact->email)->subject('Profile Update Reminder');
          });  
        }

        $this->info('Message sent succesfully');
    }
}
