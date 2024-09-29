<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enum\UserStatus;
use App\Enum\UserStorageType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testGetNameReturnsFullName()
    {
        $user = new User(['first_name' => 'John', 'last_name' => 'Doe']);
        $this->assertEquals('John Doe', $user->getName());
    }

    public function testGetEmailReturnsCorrectEmail()
    {
        $user = new User(['email' => 'test@example.com']);
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    public function testGetPasswordReturnsCorrectPassword()
    {
        $plainPassword = 'plain_password';
        $hashedPassword = Hash::make($plainPassword);

        $user = new User(['password' => $hashedPassword]);
        $this->assertTrue(Hash::check($plainPassword, $user->getPassword()));
    }

    public function testGetRoleReturnsCorrectRole()
    {
        $user = new User(['role' => 'admin']);
        $this->assertEquals('admin', $user->getRole());
    }

    public function testGetStatusReturnsCorrectStatus()
    {
        $status = UserStatus::ACTIVE;
        $user = new User(['status' => $status]);
        $this->assertEquals($status, $user->getStatus());
    }

    public function testGetUserStorageTypeReturnsCorrectType()
    {
        $storageType = UserStorageType::MIXPANEL;
        $user = new User(['user_storage_type' => $storageType]);
        $this->assertEquals($storageType, $user->getUserStorageType());
    }

    public function testGetDeletedAtReturnsCorrectDate()
    {
        $date = Carbon::now();
        $user = new User(['deleted_at' => $date]);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $user->getDeletedAt()->format('Y-m-d H:i:s'));
    }

    public function testGetCreatedAtReturnsCorrectDate()
    {
        $date = Carbon::now();
        $user = new User(['created_at' => $date]);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $user->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testGetUpdatedAtReturnsCorrectDate()
    {
        $date = Carbon::now();
        $user = new User(['updated_at' => $date]);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $user->getUpdatedAt()->format('Y-m-d H:i:s'));
    }

    public function testGetLastSyncedAtReturnsCorrectDate()
    {
        $date = Carbon::now();
        $user = new User(['last_synced_at' => $date]);
        $this->assertEquals($date->format('Y-m-d H:i:s'), $user->getLastSyncedAt()->format('Y-m-d H:i:s'));
    }

    public function testIsInSyncReturnsTrueWhenInSync()
    {
        $date = Carbon::now();
        $user = new User(['last_synced_at' => $date, 'updated_at' => $date]);
        $this->assertTrue($user->isInSync());
    }

    public function testIsInSyncReturnsFalseWhenNotInSync()
    {
        $date = Carbon::now()->subSeconds(20);
        $user = new User(['last_synced_at' => $date, 'updated_at' => Carbon::now()]);
        $this->assertFalse($user->isInSync());
    }

    public function testIsInSyncReturnsFalseWhenLastSyncedAtIsNull()
    {
        $user = new User(['last_synced_at' => null]);
        $this->assertFalse($user->isInSync());
    }
}
