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

/**
 * User model class.
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_storage_type' => UserStorageType::class,
        'status' => UserStatus::class,
        'deleted_at' => 'datetime',
        'last_synced_at' => 'datetime',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UserWasCreated::class,
        'updated' => UserWasUpdated::class,
        'deleted' => UserWasDeleted::class,
    ];

    /**
     * Get the user's ID.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute('first_name')
            . ' ' . $this->getAttribute('last_name');
    }

    /**
     * Get the user's first name.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->getAttribute('first_name');
    }

    /**
     * Get the user's last name.
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->getAttribute('last_name');
    }

    /**
     * Get the user's email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getAttribute('email');
    }

    /**
     * Get the user's password.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getAttribute('password');
    }

    /**
     * Get the user's role.
     *
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->getAttribute('role');
    }

    /**
     * Get the user's status.
     *
     * @return UserStatus
     */
    public function getStatus(): UserStatus
    {
        return $this->getAttribute('status');
    }

    /**
     * Get the user's storage type.
     *
     * @return UserStorageType
     */
    public function getUserStorageType(): UserStorageType
    {
        return $this->getAttribute('user_storage_type');
    }

    /**
     * Get the timestamp when the user was deleted.
     *
     * @return Carbon
     */
    public function getDeletedAt(): Carbon
    {
        return $this->getAttribute('deleted_at');
    }

    /**
     * Get the timestamp when the user was created.
     *
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute('created_at');
    }

    /**
     * Get the timestamp when the user was last updated.
     *
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute('updated_at');
    }

    /**
     * Get the timestamp when the user was last synced.
     *
     * @return Carbon|null
     */
    public function getLastSyncedAt(): ?Carbon
    {
        return $this->getAttribute('last_synced_at');
    }

    /**
     * Check if the user is in sync.
     *
     * @return bool
     */
    public function isInSync(): bool
    {
        if ($this->getLastSyncedAt() === null) {
            return false;
        }

        return $this->getLastSyncedAt()->diffInSeconds($this->getUpdatedAt()) <= 10;
    }
}
