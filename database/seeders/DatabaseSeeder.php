<?php

namespace Database\Seeders;

use App\Enum\UserStatus;
use App\Enum\UserStorageType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'first_name' => 'Rick',
            'last_name' => 'Willemsma',
            'email' => 'rick@example.com',
            'status' => UserStatus::ACTIVE,
            'user_storage_type' => UserStorageType::MIXPANEL,
            'role' => 'ROLE_ADMIN',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'last_synced_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
