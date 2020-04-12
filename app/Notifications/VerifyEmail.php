<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail as Notification;
use Illuminate\Support\Facades\URL;

/**
 * Class VerifyEmail
 *
 * @package App\Notifications
 */
class VerifyEmail extends Notification
{
    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'api.guest.verification.verify', Carbon::now()->addMinutes(60), ['user' => $notifiable->getKey()]
        );

        return str_replace('/api', '', $url);
    }
}
