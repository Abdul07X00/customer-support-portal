<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('tickets')->insert([
            [
            'user_id'       => $faker->numberBetween(1,2),
            'title'         => $faker->catchPhrase(),
            'status'        => 3,
            'created_at'    => $faker->dateTimeBetween('now'),
            'updated_at'    => $faker->dateTimeBetween('now'),
            ],[
            'user_id'       => $faker->numberBetween(1,2),
            'title'         => $faker->catchPhrase(),
            'status'        => 3,
            'created_at'    => $faker->dateTimeBetween('now'),
            'updated_at'    => $faker->dateTimeBetween('now'),
            ]
        ]);
    }
}
