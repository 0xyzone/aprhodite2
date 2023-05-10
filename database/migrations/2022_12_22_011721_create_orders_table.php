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
            $table->string('fullName');
            $table->string('phone');
            $table->string('alt-phone')->nullable();
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('advance')->nullable();
            $table->integer('total_price')->nullable();
            $table->string('gateway')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('delivery_status')->nullable();
            $table->integer('rider_id')->nullable();
            $table->string('order_status')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
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
