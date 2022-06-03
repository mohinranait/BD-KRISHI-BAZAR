<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                  ->index()
                  ->nullable();
            $table->text('description')
                  ->nullable();
            $table->integer('category_id')
                  ->nullable();
            $table->integer('subject_id')
                  ->nullable();
            $table->integer('class_id')
                  ->nullable();
            $table->string('excerpt')->nullable();
            $table->string('feature_img_name')
                  ->nullable();
            $table->string('feature_img_original_name')
                  ->nullable();
            $table->string('feature_img_mime')
                  ->nullable();
            $table->string('feature_img_ext')
                  ->nullable();
            $table->string('video_source')->default('uploaded');
            //uploaded, googledrive, youtube, embed,

            $table->string('video_file_name')->nullable();
            //if uploaded

            $table->string('document_file_name')->nullable();
            $table->string('document_file_ext')->nullable();

            $table->string('embed_code')->nullable();
            //for googledrive, youtube, embed
            
            $table->string('status') //online desk, online protibedon
                  ->nullable();
            $table->text('tags')->nullable(); //for search
            $table->integer('read')->default(0);
            $table->boolean('headline')->default(0);
            $table->boolean('front_slider')->default(0);
            $table->boolean('highlight')->default(0);
            $table->string('publish_status')->default('temp'); //temp, draft, published
            $table->integer('addedby_id')
                  ->unsigned()
                  ->nullable();
            $table->integer('editedby_id')
                  ->unsigned()
                  ->nullable();
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
        Schema::dropIfExists('posts');
    }
}
