<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ls = ["ลำไยสีชมพู", "ลำไยตลับนาค", "ลำไยเบี้ยวเขียว", "ลำไยอีแดง", "ลำไยอีดอ"];
        $prices = [45, 50, 55, 40, 55];

        for ($i = 0; $i < 5; $i++) {
            $product = new Product();
            $product->product_name = $ls[$i];
            $product->product_img_path = "storage/pictures/icons/default_product.jpg";
            $product->price = $prices[$i];

            $product->save();
        }
    }
}
