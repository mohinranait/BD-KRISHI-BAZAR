<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("product_name");
            $table->string("slug");
            $table->string('price')->nullable();
            $table->string('weight')->nullable();
            $table->string('quintity')->nullable();
            $table->unsignedInteger('shop_id')->nullable();
            $table->integer('status')->default(1)->comment("1=active, 2=in-active");
            $table->text("description")->nullable();
            $table->text("product_image")->nullable();
            $table->string("meta_title")->nullable();
            $table->text("meta_description")->nullable();
            $table->text("meta_keyword")->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('products');
    }
}
