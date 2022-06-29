<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'phone' => $faker->phoneNumber,
                'uid' => rand(10000000000, 99999999999),
                'avatar' => 'avat.png',
                'gender' => 1,
                'birthday' => "2001-01-01",
                'status' => 1,
                'login_method_id' => 1,
                'password' => '$2y$10$efKbPeLQXcMYu8a.WgZiH.z5Boj5EX56n9sLXd00Dw1cqrkNucDcy',
            ]);
        }
    }
}