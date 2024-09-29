<?php

declare(strict_types=1);

namespace App\Providers;

use App\Consumer\SyncUserToExternal;
use App\Event\User\UserWasCreated;
use App\Event\User\UserWasDeleted;
use App\Event\User\UserWasLoggedIn;
use App\Event\User\UserWasUpdated;
use App\Listeners\DispatchUserWasLoggedIn;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @codeCoverageIgnore
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserWasCreated::class => [
            SyncUserToExternal::class,
        ],
        UserWasUpdated::class => [
            SyncUserToExternal::class,
        ],
        UserWasDeleted::class => [
            SyncUserToExternal::class,
        ],
        UserWasLoggedIn::class => [
            SyncUserToExternal::class,
        ],
        Login::class => [
            DispatchUserWasLoggedIn::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
