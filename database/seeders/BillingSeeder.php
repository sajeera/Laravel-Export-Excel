<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Billing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = collect(User::all()->modelKeys());
        $data = [];

        for ($i = 0; $i < 10000; $i++) {
            $data[] = [
                'amount'        => rand(10000, 99999),
                'description'   => $faker->sentence(),
                'user_id'       => $users->random(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        $chunks = array_chunk($data, 5000);

        foreach ($chunks as $chunk) {
            Billing::insert($chunk);
        }
    }
}
