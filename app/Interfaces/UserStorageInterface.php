<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\User;

/**
 * Interface for user storage operations.
 */
interface UserStorageInterface
{
    /**
     * Creates a user.
     *
     * @param User $user The user to be created.
     * @return bool True on success, false on failure.
     */
    public function createUser(User $user): bool;

    /**
     * Updates a user.
     *
     * @param User $user The user to be updated.
     * @return bool True on success, false on failure.
     */
    public function updateUser(User $user): bool;

    /**
     * Deletes a user.
     *
     * @param User $user The user to be deleted.
     * @return bool True on success, false on failure.
     */
    public function deleteUser(User $user): bool;

    /**
     * Tracks user login activity.
     *
     * @param User $user The user who logged in.
     * @return bool True on success, false on failure.
     */
    public function userLoggedIn(User $user): bool;
}
