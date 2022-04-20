<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            [
                'name'              => $faker->name(),
                'email'             => $faker->email(),
                'password'          => Hash::make('password'),
                'user_type'         => 'customer',
                'status'            => 1,
                'email_verified_at' => now(),
            ],[
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                'password'  => Hash::make('password'),
                'user_type' => 'support',
                'status'    => 1,
                'email_verified_at' => now(),
            ]
        ]);

    }
}
