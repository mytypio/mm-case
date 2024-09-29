<?php

declare(strict_types=1);

namespace Tests\Unit\Event;

use App\Enum\UserStorageType;
use App\Interfaces\UserEventInterface;
use App\Models\User;

class UnknownUserEvent implements UserEventInterface
{
    public function getUserStorageType(): UserStorageType
    {
        return UserStorageType::MIXPANEL;
    }

    public function getPayload(): User
    {
        return new User();
    }
}
