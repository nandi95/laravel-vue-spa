<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\OAuthProvider::class, function(Faker $faker) {
    return [
        'user_id'          => function () {
            return factory(User::class)->create()->getKey();
        },
        'provider'         => 'github',
        'provider_user_id' => Str::random(),
        'access_token' => Str::random(),
        'refresh_token' => Str::random()
    ];
});
