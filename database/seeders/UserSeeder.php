<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = new User;
        // $user->username = "ILoveKimDoyoung";
        // $user->password = Hash::make("12345678");
        // $user->save();

        $user = new User;
        $user->username = "todayis_pana";
        $user->password = Hash::make("12345678");
        $user->role = 2;
        $user->save();

        $seller = new Seller();
        $seller->user_id = $user->id;
        $seller->name = "today pana";
        $seller->bank_name = "ธนาคารอังกฤษพาณิชย์";
        $seller->bank_number = "12345678";
        $seller->save();


    }
}
