<?php

declare(strict_types=1);

namespace App\Consumer;

use App\Event\User\UserWasCreated;
use App\Event\User\UserWasDeleted;
use App\Event\User\UserWasLoggedIn;
use App\Event\User\UserWasUpdated;
use App\Factory\UserStorageAdapterFactory;
use App\Interfaces\UserEventInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncUserToExternal implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(
        private readonly UserStorageAdapterFactory $adapterFactory,
    ) {
    }

    public function handle(UserEventInterface $event): bool
    {
        $adapter = $this->adapterFactory->resolve($event->getUserStorageType());

        $result = match (true) {
            $event instanceof UserWasCreated => $adapter->createUser($event->getPayload()),
            $event instanceof UserWasUpdated => $adapter->updateUser($event->getPayload()),
            $event instanceof UserWasDeleted => $adapter->deleteUser($event->getPayload()),
            $event instanceof UserWasLoggedIn => $adapter->userLoggedIn($event->getPayload()),
            default => false,
        };

        if ($result) {
            $event->getPayload()->withoutEvents(
                function () use ($event) {
                    $event->getPayload()->update(['last_synced_at' => now()]);
                }
            );

            return true;
        }

        return false;
    }
}
