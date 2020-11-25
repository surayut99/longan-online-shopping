<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected static $products;
    protected static function addCart($id , $amount) {
        $product = ['id'=> $id , 'amount' => $amount];
        static::$products = $product ;
        return static::$products;
    }

}
