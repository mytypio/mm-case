<?php

declare(strict_types=1);

namespace App\Event\User;

use App\Enum\UserStorageType;
use App\Interfaces\UserEventInterface;
use App\Models\User;

/**
 * Event class representing the creation of a user.
 * Implements the UserEventInterface.
 */
final class UserWasCreated implements UserEventInterface
{
    /**
     * Constructor for UserWasCreated.
     *
     * @param User $user The user that was created.
     */
    public function __construct(
        private readonly User $user,
    ) {
    }

    /**
     * Get the user storage type.
     *
     * @return UserStorageType The storage type of the user.
     */
    public function getUserStorageType(): UserStorageType
    {
        return $this->user->getUserStorageType();
    }

    /**
     * Get the payload of the event.
     *
     * @return User The user that was created.
     */
    public function getPayload(): User
    {
        return $this->user;
    }
}
