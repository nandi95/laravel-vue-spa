<?php

use App\Models\Authorisation\Permission;
use App\Models\Authorisation\PermissionGroup;
use Illuminate\Database\Seeder;

/**
 * Class PermissionSeeder
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->crudPermissions();
        $this->uniquePermissions();
    }

    /**
     * Dedicated for only running crud related permissions.
     *
     * @return void
     */
    public function crudPermissions()
    {
        $this->permissions(
            $this->group('Users'),
            $this->crud('user')
        );
    }

    /**
     * Dedicated for running unique one-off permissions.
     * @return void
     */
    public function uniquePermissions()
    {
        $permissionNames = [];
        foreach ($permissionNames as $name) {
            Permission::create([
                'name' => $name
            ]);
        }
    }

    /**
     * First or create a permission
     *
     * @param PermissionGroup $group
     * @param array $permissions
     *
     * @return void
     */
    protected function permissions(PermissionGroup $group, $permissions)
    {
        foreach ($permissions as $name => $label) {
            $this->permission($group, $name, $label);
        }
    }

    /**
     * Seed a permission
     *
     * @param PermissionGroup $group
     * @param string $name
     * @param string $label
     *
     * @return Permission
     */
    protected function permission(PermissionGroup $group, $name, $label)
    {
        $permission                          = Permission::firstOrNew(['name' => $name]);
        $permission[$permission->foreignKey] = $group->getKey();
        $permission->label                   = $label;
        $permission->save();
        return $permission;
    }

    /**
     * First or create a permission group
     *
     * @param $name
     *
     * @return PermissionGroup
     */
    protected function group($name)
    {
        return PermissionGroup::firstOrCreate(
            compact('name')
        );
    }


    /**
     * Generate an array of CRUD permissions
     *
     * @param string $suffix
     * @param string $include
     *
     * @return array
     */
    protected function crud(string $suffix, string $include = 'crud')
    {
        $include = strtolower($include);

        $name = ucwords(preg_replace('/[_-]+/', ' ', $suffix));

        $permissions = [];

        if (strpos($include, 'c') !== false) {
            $permissions[$suffix . '.create'] = 'Add ' . $name;
        }

        if (strpos($include, 'r') !== false) {
            $permissions[$suffix . '.read'] = 'View ' . $name;
        }

        if (strpos($include, 'u') !== false) {
            $permissions[$suffix . '.update'] = 'Edit ' . $name;
        }

        if (strpos($include, 'd') !== false) {
            $permissions[$suffix . '.delete'] = 'Delete ' . $name;
        }

        return $permissions;
    }
}
