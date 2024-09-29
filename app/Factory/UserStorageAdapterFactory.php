<?php

declare(strict_types=1);

namespace App\Factory;

use App\Adapter\MixPanelAdapter;
use App\Enum\UserStorageType;
use App\Interfaces\UserStorageInterface;

/**
 * Factory class for creating user storage adapters.
 */
class UserStorageAdapterFactory
{
    /**
     * Resolves the appropriate user storage adapter based on the given storage type.
     *
     * @param UserStorageType $storageType The type of user storage.
     * @return UserStorageInterface The resolved user storage adapter.
     * @throws \InvalidArgumentException If the storage type is unknown.
     */
    public function resolve(UserStorageType $storageType): UserStorageInterface
    {
        return match ($storageType) {
            UserStorageType::MIXPANEL => new MixPanelAdapter(),
            default => throw new \InvalidArgumentException('Unknown storage type'),
        };
    }
}
