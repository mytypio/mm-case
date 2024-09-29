<?php

declare(strict_types=1);

namespace Tests\Unit\Exceptions;

use App\Exceptions\MixPanelException;
use Tests\TestCase;

class ExceptionsTest extends TestCase
{
    public function testCreatesExceptionForMissingMixpanelId()
    {
        $exception = MixPanelException::forId('123');
        $this->assertEquals(
            'Mixpanel id "123" not found',
            $exception->getMessage()
        );
    }

    public function testCreatesExceptionForMissingMixpanelEmail()
    {
        $exception = MixPanelException::forEmail('test@example.com');
        $this->assertEquals(
            'Mixpanel email "test@example.com" not found',
            $exception->getMessage()
        );
    }

    public function testCreatesExceptionForFailedUserCreation()
    {
        $exception = MixPanelException::failedToCreate('123');
        $this->assertEquals(
            'Mixpanel failed to create user with id "123"',
            $exception->getMessage()
        );
    }

    public function testCreatesExceptionForFailedUserUpdate()
    {
        $exception = MixPanelException::failedToUpdate('123');
        $this->assertEquals(
            'Mixpanel failed to update user with id "123"',
            $exception->getMessage()
        );
    }

    public function testCreatesExceptionForFailedUserDeletion()
    {
        $exception = MixPanelException::failedToDelete(1);
        $this->assertEquals(
            'Mixpanel failed to delete user with id "1"',
            $exception->getMessage()
        );
    }

    public function testCreatesExceptionForUnknownError()
    {
        $exception = MixPanelException::unknownError('Unknown error occurred');
        $this->assertEquals(
            'Mixpanel error: Unknown error occurred',
            $exception->getMessage()
        );
    }

    public function testCreatesExceptionForFailedEventTracking()
    {
        $exception = MixPanelException::failedToTrack('123', 'user.created');
        $this->assertEquals(
            'Mixpanel failed to track event "user.created" for user with id "123"',
            $exception->getMessage()
        );
    }
}
