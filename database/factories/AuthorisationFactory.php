<?php

/** @var Factory $factory */

use App\Models\Authorisation\Permission;
use App\Models\Authorisation\PermissionGroup;
use App\Models\Authorisation\Role;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;

$factory->define(PermissionGroup::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word)
    ];
});

$factory->define(Permission::class, function (Faker $faker) {
    $group = factory(PermissionGroup::class)->create();
    $name = $faker->name;

    return [
        $group->getTable() . '_id' => $group->getKey(),
        'name' => $group->name . '.' . $name,
        'label' => ucfirst($group->name) . ' ' . ucfirst($name),
        'guard_name' => null
    ];
});

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'guard_name' => config('auth.defaults.guard')
    ];
});
