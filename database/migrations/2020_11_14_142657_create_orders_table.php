<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("product_id");

            $table->enum("status", ["purchasing", "verifying", "verified", "deliveried", "cancelled"])->default("purchasing");

            $table->string("shipment_detail")->nullable();
            $table->string("recv_name");
            $table->string("recv_address");
            $table->string("recv_tel");
            $table->string("comment")->nullable();
            $table->string("img_path")->nullable();

            $table->float("amount");
            $table->float("price_per_unit");

            $table->dateTime("expired_at")->nullable();
            $table->timestamps(); // contain ordered_at and verified_at/cancelled_at/deliveried_at/purchased_at depending on order status

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("product_id")->references("id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
