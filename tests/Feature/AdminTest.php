<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminPageIsDisplayed(): void
    {
        $user = User::factory()->create([
            'role' => 'ROLE_ADMIN',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/admin/dashboard');

        $response->assertOk();
    }

    public function testAdminUsersPageIsDisplayed(): void
    {
        $user = User::factory()->create([
            'role' => 'ROLE_ADMIN',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/admin/users');

        $response->assertOk();
    }

    public function testAdminUserDetailPageIsDisplayed(): void
    {
        $user = User::factory()->create([
            'role' => 'ROLE_ADMIN',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/admin/users/' . $user->id);

        $response->assertOk();
    }

    public function testAdminUserCanActivateUser(): void
    {
        $user = User::factory()->create([
            'role' => 'ROLE_ADMIN',
        ]);

        $userToActivate = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/admin/users/' . $userToActivate->id . '/activate');

        $response->assertRedirect('/admin/users/' . $userToActivate->id);
    }

    public function testAdminUserCanSyncUser(): void
    {
        $user = User::factory()->create([
            'role' => 'ROLE_ADMIN',
        ]);

        $userToSync = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/admin/users/' . $userToSync->id . '/sync');

        $response->assertRedirect('/admin/users/' . $userToSync->id);
    }
}
