<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotel = [
            'Mango Bay Resort',
            'Chen Sea Resort &Spa Phu Quoc',
            'Chez Carole Beach Resort'
        ];

        $faker = Factory::create();
        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('tours')->insert([
                'code' => "NT" . rand(1000000000, 9999999999),
                'type_id' => rand(1, 4),
                'promotion_id' => 1,
                'hotel' => array_rand($hotel),
                'schedule' => "Two years of raging pandemic and concerns surrounding health issues 
                               have kept many travel lovers staying at home, putting aside their passion 
                               for travel",
                'date_to' => "2022-01-04",
                'date_from' => "2022-01-01",
                'name' =>  $faker->name,
                'image' => 1,
                'price_child' => 100000,
                'price_adult' => 100000,
                'start_location_id' => 1,
                'end_location_id' => 2,
                'capacity' => 100,
                'available_capacity' => 200,
                'vehicle_id' => 2,
                'description' => null,
                'status' => rand(1, 2),
            ]);
        }
    }
}