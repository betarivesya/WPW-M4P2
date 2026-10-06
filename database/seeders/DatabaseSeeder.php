<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'first_name' => 'Test',
                'last_name' => 'User',
                'status' => 'active',
                'role' => 'member',
                'age' => 25,
                'active' => true,
                'email_verified_at' => now(),
                'trashed' => false,
            ],
            [
                'name' => 'Conditional Admin',
                'email' => 'conditional-admin@example.test',
                'first_name' => 'Conditional',
                'last_name' => 'Admin',
                'status' => 'active',
                'role' => 'admin',
                'age' => 28,
                'active' => true,
                'email_verified_at' => now(),
                'trashed' => false,
            ],
            [
                'name' => 'Conditional Editor',
                'email' => 'conditional-editor@example.test',
                'first_name' => 'Conditional',
                'last_name' => 'Editor',
                'status' => 'active',
                'role' => 'editor',
                'age' => 24,
                'active' => true,
                'email_verified_at' => now(),
                'trashed' => false,
            ],
            [
                'name' => 'Inactive Admin',
                'email' => 'conditional-inactive-admin@example.test',
                'first_name' => 'Inactive',
                'last_name' => 'Admin',
                'status' => 'inactive',
                'role' => 'admin',
                'age' => 35,
                'active' => false,
                'email_verified_at' => now(),
                'trashed' => false,
            ],
            [
                'name' => 'Unverified Editor',
                'email' => 'conditional-unverified-editor@example.test',
                'first_name' => 'Unverified',
                'last_name' => 'Editor',
                'status' => 'active',
                'role' => 'editor',
                'age' => 30,
                'active' => true,
                'email_verified_at' => null,
                'trashed' => false,
            ],
            [
                'name' => 'Underage Member',
                'email' => 'conditional-underage-member@example.test',
                'first_name' => 'Underage',
                'last_name' => 'Member',
                'status' => 'inactive',
                'role' => 'member',
                'age' => 17,
                'active' => false,
                'email_verified_at' => now(),
                'trashed' => false,
            ],
            [
                'name' => 'Trashed Editor',
                'email' => 'conditional-trashed-editor@example.test',
                'first_name' => 'Trashed',
                'last_name' => 'Editor',
                'status' => 'active',
                'role' => 'editor',
                'age' => 26,
                'active' => true,
                'email_verified_at' => now(),
                'trashed' => true,
            ],
        ];

        foreach ($users as $attributes) {
            $trashed = $attributes['trashed'];
            unset($attributes['trashed']);

            $user = User::withTrashed()->updateOrCreate(
                ['email' => $attributes['email']],
                [...$attributes, 'password' => 'password']
            );

            if ($trashed && ! $user->trashed()) {
                $user->delete();
            } elseif (! $trashed && $user->trashed()) {
                $user->restore();
            }
        }
    }
}
