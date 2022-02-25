<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->string('gallery_name')->string();
            $table->bigInteger('gallery_id')->unsigned()->index()->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('featured_img_1')->nullable();
            $table->bigInteger('featured_img_2')->nullable();
            $table->bigInteger('featured_img_3')->nullable();
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
        Schema::dropIfExists('galleries');
    }
}
