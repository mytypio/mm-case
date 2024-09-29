<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Enum\UserStatus;
use App\Exceptions\MixPanelException;
use App\Service\Mixpanel;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class MixpanelTest extends TestCase
{
    private Mixpanel $mixpanel;
    private Client $client;

    protected function setUp(): void
    {
        $this->client = $this->createMock(Client::class);
        $this->mixpanel = new Mixpanel('test_api_token');
        $this->mixpanel->client = $this->client;
    }

    /**
     * @throws MixPanelException
     */
    public function testCreatesUserSuccessfully()
    {
        $data = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'role' => 'ROLE_ADMIN',
            'status' => UserStatus::ACTIVE->value,
        ];

        $this->client->method('post')
            ->willReturn(new Response(200, [], json_encode(['error' => null])));

        $this->assertTrue($this->mixpanel->createUser($data));
    }

    /**
     * @throws MixPanelException
     */
    public function testUpdatesUserSuccessfully()
    {
        $data = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'role' => 'ROLE_ADMIN',
            'status' => UserStatus::ACTIVE->value,
            'changes' => ['email' => 'new.email@example.com'],
        ];

        $this->client->method('post')
            ->willReturn(new Response(200, [], json_encode(['error' => null])));

        $this->assertTrue($this->mixpanel->updateUser($data));
    }

    /**
     * @throws MixPanelException
     */
    public function testDeletesUserSuccessfully()
    {
        $this->client->method('post')
            ->willReturn(new Response(200, [], json_encode(['error' => null])));

        $this->assertTrue($this->mixpanel->deleteUser(1));
    }

    /**
     * @throws MixPanelException
     */
    public function testTracksUserActivitySuccessfully()
    {
        $this->client->method('post')
            ->willReturn(new Response(200, [], json_encode(['error' => null])));

        $this->assertTrue($this->mixpanel->trackUserActivity('123', 'user.created'));
    }

    /**
     * @throws MixPanelException
     */
    public function testCreateUserThrowsExceptionOnFailedRequest()
    {
        $data = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'role' => 'ROLE_ADMIN',
            'status' => UserStatus::ACTIVE->value,
        ];

        $this->client->method('post')
            ->willReturn(new Response(500, [], json_encode(['error' => 'Some error'])));

        $this->expectException(MixPanelException::class);
        $this->mixpanel->createUser($data);
    }

    /**
     * @throws MixPanelException
     */
    public function testUpdateUserThrowsExceptionOnFailedRequest()
    {
        $data = [
            'id' => 1,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'role' => 'ROLE_ADMIN',
            'status' => UserStatus::ACTIVE->value,
            'changes' => ['email' => 'new.email@example.com'],
        ];

        $this->client->method('post')
            ->willReturn(new Response(500, [], json_encode(['error' => 'Some error'])));

        $this->expectException(MixPanelException::class);
        $this->mixpanel->updateUser($data);
    }

    /**
     * @throws MixPanelException
     */
    public function testDeleteUserThrowsExceptionOnFailedRequest()
    {
        $this->client->method('post')
            ->willReturn(new Response(500, [], json_encode(['error' => 'Some error'])));

        $this->expectException(MixPanelException::class);
        $this->mixpanel->deleteUser(1);
    }

    /**
     * @throws MixPanelException
     */
    public function testTrackUserActivityThrowsExceptionOnFailedRequest()
    {
        $this->client->method('post')
            ->willReturn(new Response(500, [], json_encode(['error' => 'Some error'])));

        $this->expectException(MixPanelException::class);
        $this->mixpanel->trackUserActivity(1, 'user.created');
    }
}
