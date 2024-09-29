<?php

declare(strict_types=1);

namespace App\Event\User;

use App\Enum\UserStorageType;
use App\Interfaces\UserEventInterface;
use App\Models\User;

final class UserWasLoggedIn implements UserEventInterface
{
    public function __construct(
        private readonly User $user,
    ) {
    }

    public function getUserStorageType(): UserStorageType
    {
        return $this->user->getUserStorageType();
    }

    public function getPayload(): User
    {
        return $this->user;
    }
}
