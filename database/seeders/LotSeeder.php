<?php

namespace Database\Seeders;

use App\Models\Lot;
use Illuminate\Database\Seeder;

class LotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qty = [100, 200, 120, 150, 80];

        for ($i = 0; $i < 5; $i++) {
            $lot = new Lot();
            $lot->product_id = $i + 1;
            $lot->added_qty = $qty[$i];
            $lot->current_qty = $qty[$i];

            $lot->save();
        }
    }
}
