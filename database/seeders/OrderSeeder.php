<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'user_id' => 22,
                'pickup_address' => '123 Main St, Springfield',
                'delivery_address' => '456 Elm St, Shelbyville',
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'user_id' => 22,
                'pickup_address' => '789 Oak St, Springfield',
                'delivery_address' => '321 Maple St, Shelbyville',
                'status' => 'in_progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'user_id' => 23,
                'pickup_address' => '555 Pine St, Capital City',
                'delivery_address' => '777 Cedar St, Shelbyville',
                'status' => 'delivered',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
