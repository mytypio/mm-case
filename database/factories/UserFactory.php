<?php

namespace Database\Factories;

use App\Enum\UserStatus;
use App\Enum\UserStorageType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $faker = FakerFactory::create('nl_NL');

        return [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'status' => UserStatus::ACTIVE,
            'user_storage_type' => UserStorageType::MIXPANEL,
            'role' => 'ROLE_USER',
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'last_synced_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
