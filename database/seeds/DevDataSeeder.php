<?php

use App\Models\Authorisation\Permission;
use App\Models\Authorisation\PermissionGroup;
use App\Models\Authorisation\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DevDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = factory(Role::class)->create(['name' => 'Tester']);
        $permissionGroup = factory(PermissionGroup::class)->create(['name' => 'Test']);
        $permission = Permission::create([
            'name' => 'test.update',
            'label' => 'Update Test',
            $permissionGroup->getTable() . '_id' => $permissionGroup->getKey(),
        ]);
        $role->givePermissionTo($permission);
        User::whereEmail('development@' . parse_url(config('app.url'))['host'])->first()->assignRole($role);
    }
}
