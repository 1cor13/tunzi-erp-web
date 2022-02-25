<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('gallery_id')->unsigned()->index()->nullable();
            $table->boolean('featured')->nullable();
            $table->integer('featured_no')->nullable();
            $table->string('image_name');
            $table->string('image_path')->nullable();
            $table->string('alternative_text')->nullable();
            $table->string('image_caption')->nullable();
            $table->text('image_description')->nullable();
            $table->string('status')->nullable()->default('active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
