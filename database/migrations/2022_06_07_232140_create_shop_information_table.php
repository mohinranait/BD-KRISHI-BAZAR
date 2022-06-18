<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_information', function (Blueprint $table) {
            $table->id();
            $table->string("shop_name")->nullable();
            $table->string("slug");
            $table->string("shop_email")->nullable();
            $table->string("shop_phone")->nullable();
            $table->text("shop_user_profile")->nullable();
            $table->unsignedBigInteger("shop_district_id");
            $table->unsignedBigInteger("shop_upzila_id");
            $table->unsignedBigInteger("shop_user_id");
            $table->text("shop_cover_photo")->nullable();
            $table->text("shop_logo")->nullable();
            $table->integer("status")->default(1)->comment("1=active, 2=in-active");
            $table->timestamps();
			
            $table->foreign('shop_user_id')->references('id')->on('users');
            $table->foreign('shop_district_id')->references('id')->on('districts');
            $table->foreign('shop_upzila_id')->references('id')->on('upazilas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_information');
    }
}
