<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Class MixPanelException
 *
 * Custom exception class for handling Mixpanel-related errors.
 */
class MixPanelException extends Exception
{
    /**
     * Creates an exception for a missing Mixpanel ID.
     *
     * @param  string $id The Mixpanel ID that was not found.
     * @return self
     */
    public static function forId(string $id): self
    {
        return new self(
            sprintf('Mixpanel id "%s" not found', $id),
        );
    }

    /**
     * Creates an exception for a missing Mixpanel email.
     *
     * @param  string $email The Mixpanel email that was not found.
     * @return self
     */
    public static function forEmail(string $email): self
    {
        return new self(
            sprintf('Mixpanel email "%s" not found', $email),
        );
    }

    /**
     * Creates an exception for a failed user creation in Mixpanel.
     *
     * @param  string $id The Mixpanel ID of the user that failed to be created.
     * @return self
     */
    public static function failedToCreate(string $id): self
    {
        return new self(
            sprintf('Mixpanel failed to create user with id "%s"', $id),
        );
    }

    /**
     * Creates an exception for a failed user update in Mixpanel.
     *
     * @param  string $id The Mixpanel ID of the user that failed to be updated.
     * @return self
     */
    public static function failedToUpdate(string $id): self
    {
        return new self(
            sprintf('Mixpanel failed to update user with id "%s"', $id),
        );
    }

    /**
     * Creates an exception for a failed user deletion in Mixpanel.
     *
     * @param  int $id The Mixpanel ID of the user that failed to be deleted.
     * @return self
     */
    public static function failedToDelete(int $id): self
    {
        return new self(
            sprintf('Mixpanel failed to delete user with id "%s"', $id),
        );
    }

    /**
     * Creates an exception for an unknown Mixpanel error.
     *
     * @param  string $message The error message.
     * @return self
     */
    public static function unknownError(string $message): self
    {
        return new self(
            'Mixpanel error: ' . $message,
        );
    }

    /**
     * Creates an exception for a failed event tracking in Mixpanel.
     *
     * @param  string $id    The Mixpanel ID of the user.
     * @param  string $event The event that failed to be tracked.
     * @return self
     */
    public static function failedToTrack(string $id, string $event): self
    {
        return new self(
            sprintf('Mixpanel failed to track event "%s" for user with id "%s"', $event, $id),
        );
    }
}
