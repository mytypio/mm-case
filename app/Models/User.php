<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\UserStatus;
use App\Enum\UserStorageType;
use App\Event\User\UserWasCreated;
use App\Event\User\UserWasDeleted;
use App\Event\User\UserWasUpdated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'status',
        'user_storage_type',
        'last_synced_at',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_storage_type' => UserStorageType::class,
        'status' => UserStatus::class,
        'deleted_at' => 'datetime',
        'last_synced_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => UserWasCreated::class,
        'updated' => UserWasUpdated::class,
        'deleted' => UserWasDeleted::class,
    ];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getName(): string
    {
        return $this->getAttribute('first_name')
            . ' ' . $this->getAttribute('last_name');
    }

    public function getFirstName(): string
    {
        return $this->getAttribute('first_name');
    }

    public function getLastName(): string
    {
        return $this->getAttribute('last_name');
    }

    public function getEmail(): string
    {
        return $this->getAttribute('email');
    }

    public function getPassword(): string
    {
        return $this->getAttribute('password');
    }

    public function getRole(): ?string
    {
        return $this->getAttribute('role');
    }

    public function getStatus(): UserStatus
    {
        return $this->getAttribute('status');
    }

    public function getUserStorageType(): UserStorageType
    {
        return $this->getAttribute('user_storage_type');
    }

    public function getDeletedAt(): Carbon
    {
        return $this->getAttribute('deleted_at');
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute('updated_at');
    }

    public function getLastSyncedAt(): ?Carbon
    {
        return $this->getAttribute('last_synced_at');
    }

    public function isInSync(): bool
    {
        if ($this->getLastSyncedAt() === null) {
            return false;
        }

        return $this->getLastSyncedAt()->diffInSeconds($this->getUpdatedAt()) <= 10;
    }
}
