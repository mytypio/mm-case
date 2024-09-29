<?php

declare(strict_types=1);

namespace App\Enum;

/**
 * Enum representing the type of user storage.
 */
enum UserStorageType: string
{
    /**
     * User storage type for Mixpanel.
     */
    case MIXPANEL = 'mixpanel';
}
