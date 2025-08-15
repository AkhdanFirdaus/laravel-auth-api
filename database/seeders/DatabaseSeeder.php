<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use App\Models\UserCredential;
use App\Models\UserProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create()->each(function ($user) {
            UserProfile::factory()->for($user)->create();
            UserCredential::factory()->for($user)->emailCredential($user->email)->create();
            UserCredential::factory()->for($user)->phoneCredential()->create();

            Todo::factory(3)->for($user)->create();
        });
    }
}
