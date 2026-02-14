<?php

namespace App\Jobs;

use App\Mail\NewsletterEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $messageContent;

    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

   public function handle(): void
{
    // Utilisez le bon nom de table : newsletter_subscribers
    DB::table('newsletter_subscribers')->orderBy('id')->chunk(100, function ($subscribers) {
        foreach ($subscribers as $subscriber) {
            if (isset($subscriber->email)) {
                Mail::to($subscriber->email)
                    ->send(new NewsletterEmail($this->messageContent));
            }
        }
    });
}
}