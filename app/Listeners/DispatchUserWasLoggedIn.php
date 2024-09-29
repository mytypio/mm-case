<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Event\User\UserWasLoggedIn;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Listener class to dispatch the UserWasLoggedIn event.
 * Implements the ShouldQueue interface to handle the event asynchronously.
 */
class DispatchUserWasLoggedIn implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the login event.
     *
     * @param Login $event The login event instance.
     * @return void
     */
    public function handle(Login $event): void
    {
        event(new UserWasLoggedIn($event->user));
    }
}
