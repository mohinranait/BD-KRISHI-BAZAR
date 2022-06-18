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
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->text("address")->nullable();
            $table->string("amount")->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('shop_id')->nullable();
            $table->string('payment_method')->nullable()->comment('1=Bkash , 2=Nagad',);
            $table->string('transaction_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('is_paid')->default(1)->comment('1=cod, 2=Local pickup');
            $table->text('masseg')->nullable();
            $table->integer('status')->default(1)->comment('1=pending, 2=cancle,3=delevery,4=hold');
            $table->timestamps();

            // $table->foreign('user_id')->refference('id')->on('users')->onDelete('cascade');
            // $table->foreign('shop_id')->refference('id')->on('shop_information')->onDelete('cascade');
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
