<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Enum\UserStorageType;
use App\Models\User;

/**
 * Interface for user event classes.
 */
interface UserEventInterface
{
    /**
     * Get the user storage type.
     *
     * @return UserStorageType The storage type of the user.
     */
    public function getUserStorageType(): UserStorageType;

    /**
     * Get the payload of the event.
     *
     * @return User The user associated with the event.
     */
    public function getPayload(): User;
}
