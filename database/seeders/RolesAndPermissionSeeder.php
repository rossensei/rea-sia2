<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);

        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo(['view']);
        
        $admin1 = User::create([
            'name' => 'admin',
            'email' => 'admin@dev.fun',
            'password' => bcrypt('admin123'), // password
        ]);

        $user1 = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $admin1->assignRole('admin');
        $user1->assignRole('user');
    }
}
