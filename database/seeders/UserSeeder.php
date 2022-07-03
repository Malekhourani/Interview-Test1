<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $roles = config('role_permission');

        foreach ($roles as $role) {
            Role::findOrCreate($role);
        }

        User::factory()->createOne(['email' => 'admin@email.com'])->assignRole(User::ADMIN);
        User::factory()->createOne(['email' => 'editor@email.com'])->assignRole(User::EDITOR);
        User::factory()->createOne(['email' => 'reader@email.com'])->assignRole(User::READER);

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
