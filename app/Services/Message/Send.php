<?php

namespace App\Services\Message;

use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class Send
{
    /**
     * Send the message via email
     *
     * @param  array  $data
     * @return void
     */
    public function execute(array $data)
    {
        Notification::route('mail', env('MAIL_USERNAME'))
            ->notify(new MessageNotification($data['name'], $data['email'], $data['message']));

        Log::info($data, ['file' => __FILE__, 'line' => __LINE__, 'method' => __METHOD__]);
    }
}
