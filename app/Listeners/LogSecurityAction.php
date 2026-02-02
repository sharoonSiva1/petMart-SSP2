<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSecurityAction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event instanceof \Illuminate\Auth\Events\Login) {
            \App\Models\SecurityLog::create([
                'user_id' => $event->user->id,
                'action' => 'User Login',
                'ip_address' => request()->ip(),
                'details' => ['email' => $event->user->email],
            ]);
        } elseif ($event instanceof \Illuminate\Auth\Events\Failed) {
            \App\Models\SecurityLog::create([
                'user_id' => $event->user ? $event->user->id : null,
                'action' => 'Failed Login Attempt',
                'ip_address' => request()->ip(),
                'details' => ['email' => $event->credentials['email'] ?? null],
            ]);
        }
    }
}
