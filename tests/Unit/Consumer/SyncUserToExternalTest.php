<?php

declare(strict_types=1);

namespace Tests\Unit\Consumer;

use App\Adapter\MixPanelAdapter;
use App\Consumer\SyncUserToExternal;
use App\Event\User\UserWasCreated;
use App\Event\User\UserWasDeleted;
use App\Event\User\UserWasLoggedIn;
use App\Event\User\UserWasUpdated;
use App\Factory\UserStorageAdapterFactory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;
use Tests\Unit\Event\UnknownUserEvent;

class SyncUserToExternalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Exception
     */
    public function testHandlesUserWasCreatedEvent(): void
    {
        $event = new UserWasCreated($user = User::factory()->make());
        $adapter = $this->createMock(MixPanelAdapter::class);
        $adapter->expects($this->once())->method('createUser')->willReturn(true);

        $factory = $this->createMock(UserStorageAdapterFactory::class);
        $factory->method('resolve')->willReturn($adapter);

        $consumer = new SyncUserToExternal($factory);

        $this->assertTrue($consumer->handle($event));
        $this->assertNotNull($user->last_synced_at);
    }

    public function testHandlesUserWasUpdatedEvent()
    {
        $event = new UserWasUpdated($user = User::factory()->make());
        $adapter = $this->createMock(MixPanelAdapter::class);
        $adapter->expects($this->once())->method('updateUser')->willReturn(true);

        $factory = $this->createMock(UserStorageAdapterFactory::class);
        $factory->method('resolve')->willReturn($adapter);

        $consumer = new SyncUserToExternal($factory);

        $this->assertTrue($consumer->handle($event));
        $this->assertNotNull($user->last_synced_at);
    }

    public function testHandlesUserWasDeletedEvent()
    {
        $event = new UserWasDeleted($user = User::factory()->make());
        $adapter = $this->createMock(MixPanelAdapter::class);
        $adapter->expects($this->once())->method('deleteUser')->willReturn(true);

        $factory = $this->createMock(UserStorageAdapterFactory::class);
        $factory->method('resolve')->willReturn($adapter);

        $consumer = new SyncUserToExternal($factory);

        $this->assertTrue($consumer->handle($event));
    }

    public function testHandlesUserWasLoggedInEvent()
    {
        $event = new UserWasLoggedIn($user = User::factory()->make());
        $adapter = $this->createMock(MixPanelAdapter::class);
        $adapter->expects($this->once())->method('userLoggedIn')->willReturn(true);

        $factory = $this->createMock(UserStorageAdapterFactory::class);
        $factory->method('resolve')->willReturn($adapter);

        $consumer = new SyncUserToExternal($factory);

        $this->assertTrue($consumer->handle($event));
        $this->assertNotNull($user->last_synced_at);
    }

    public function testReturnsFalseForUnknownEvent()
    {
        $event = new UnknownUserEvent();
        $factory = $this->createMock(UserStorageAdapterFactory::class);
        $consumer = new SyncUserToExternal($factory);

        $this->assertFalse($consumer->handle($event));
    }
}
