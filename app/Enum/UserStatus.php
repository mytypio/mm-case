<?php

declare(strict_types=1);

namespace App\Enum;

/**
 * Enum representing the status of a user.
 */
enum UserStatus: string
{
    /**
     * The user is active.
     */
    case ACTIVE = 'active';

    /**
     * The user is inactive.
     */
    case INACTIVE = 'inactive';
}
