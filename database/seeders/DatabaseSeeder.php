<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoleWithUser(Role::ADMIN);
    }

    private function createRoleWithUser(string $role)
    {
        return Role::factory()->state([
            'name' => $role
        ])
            ->has(User::factory()
                ->state([
                    'name' => Str::ucfirst($role),
                    'email' => 'admin@transisi.id',
                    'password' => Hash::make('transisi'),
                ]))
            ->create();
    }
}
