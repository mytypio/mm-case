<?php

declare(strict_types=1);

namespace Tests\Unit\Enum;

use App\Enum\UserStatus;
use PHPUnit\Framework\TestCase;

class EnumsTest extends TestCase
{
    public function testUserStatusIsActive()
    {
        $this->assertEquals('active', UserStatus::ACTIVE->value);
    }

    public function testUserStatusIsInactive()
    {
        $this->assertEquals('inactive', UserStatus::INACTIVE->value);
    }

    public function testUserStatusEnumContainsActive()
    {
        $this->assertTrue(UserStatus::tryFrom('active') === UserStatus::ACTIVE);
    }

    public function testUserStatusEnumContainsInactive()
    {
        $this->assertTrue(UserStatus::tryFrom('inactive') === UserStatus::INACTIVE);
    }

    public function testUserStatusEnumDoesNotContainInvalidStatus()
    {
        $this->assertNull(UserStatus::tryFrom('invalid_status'));
    }
}
