<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Event\User\UserWasLoggedIn;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DispatchUserWasLoggedIn implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(Login $event): void
    {
        event(new UserWasLoggedIn($event->user));
    }
}
