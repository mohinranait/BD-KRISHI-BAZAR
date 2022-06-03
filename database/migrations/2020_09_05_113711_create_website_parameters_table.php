<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_parameters', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable(); //for html head title
            $table->string('short_title')->nullable(); //for fold of admin panel sidebar (3 char) TN for trust news
            $table->string('h1')->nullable();
            $table->string('logo')->nullable(); //png jpg gif
            $table->string('favicon')->nullable(); //ico
            $table->text('google_analytics_code')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('footer_address')->nullable();
            $table->string('android_apk')->nullable(); //android apk
            $table->text('footer_copyright')->nullable();
            $table->string('fb_url')->nullable();
            $table->text('google_map_code')->nullable();
            $table->string('main_color')->nullable();
            $table->string('sub_color')->nullable();
            $table->string('header_bg_color')->nullable();
            $table->string('header_text_color')->nullable();
            $table->string('footer_bg_color')->nullable();
            $table->string('footer_text_color')->nullable();
            $table->string('addthis_url')->nullable();
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
        Schema::dropIfExists('website_parameters');
    }
}
