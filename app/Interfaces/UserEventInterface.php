<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Enum\UserStorageType;
use App\Models\User;

interface UserEventInterface
{
    public function getUserStorageType(): UserStorageType;

    public function getPayload(): User;
}
