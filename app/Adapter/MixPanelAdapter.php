<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Exceptions\MixPanelException;
use App\Interfaces\UserStorageInterface;
use App\Models\User;
use App\Service\Mixpanel;

/**
 * Adapter class for interacting with Mixpanel service.
 * Implements the UserStorageInterface.
 */
class MixPanelAdapter implements UserStorageInterface
{
    /**
     * @var Mixpanel The Mixpanel service instance.
     */
    private readonly Mixpanel $mixpanel;

    /**
     * MixPanelAdapter constructor.
     * Initializes the Mixpanel service with the token from configuration.
     */
    public function __construct()
    {
        $this->mixpanel = new Mixpanel(
            config('mixpanel.token'),
            config('mixpanel.url')
        );
    }

    /**
     * Creates a user in Mixpanel.
     *
     * @param User $user The user to be created.
     * @return bool True on success, false on failure.
     * @throws MixPanelException If there is an error during the operation.
     */
    public function createUser(User $user): bool
    {
        return $this->mixpanel->createUser(
            [
                'id' => $user->getId(),
                'firstName' => $user->getAttribute('first_name'),
                'lastName' => $user->getAttribute('last_name'),
                'email' => $user->getAttribute('email'),
                'role' => $user->getAttribute('role'),
                'status' => $user->getAttribute('status'),
            ]
        );
    }

    /**
     * Updates a user in Mixpanel.
     *
     * @param User $user The user to be updated.
     * @return bool True on success, false on failure.
     * @throws MixPanelException If there is an error during the operation.
     */
    public function updateUser(User $user): bool
    {
        return $this->mixpanel->updateUser(
            [
                'id' => $user->getId(),
                'firstName' => $user->getAttribute('first_name'),
                'lastName' => $user->getAttribute('last_name'),
                'email' => $user->getAttribute('email'),
                'role' => $user->getAttribute('role'),
                'status' => $user->getAttribute('status'),
                'changes' => $user->getChanges(),
            ]
        );
    }

    /**
     * Deletes a user from Mixpanel.
     *
     * @param User $user The user to be deleted.
     * @return bool True on success, false on failure.
     * @throws MixPanelException If there is an error during the operation.
     */
    public function deleteUser(User $user): bool
    {
        return $this->mixpanel->deleteUser($user->getId());
    }

    /**
     * Tracks user login activity in Mixpanel.
     *
     * @param User $user The user who logged in.
     * @return bool True on success, false on failure.
     * @throws MixPanelException If there is an error during the operation.
     */
    public function userLoggedIn(User $user): bool
    {
        return $this->mixpanel->trackUserActivity(
            $user->getId(),
            'user.logged_in',
            []
        );
    }
}
