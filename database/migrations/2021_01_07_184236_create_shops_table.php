<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->string('shop_phone')->nullable();
            $table->string('shop_email')->nullable();
            $table->string('time_open')->nullable();
            $table->string('time_closed')->nullable();
            $table->string('shop_whatsapp')->nullable();
            $table->string('shop_facebook')->nullable();
            $table->string('shop_twitter')->nullable();
            $table->string('shop_instagram')->nullable();

            $table->string('shop_lat')->nullable();
            $table->string('shop_long')->nullable();
            $table->text('shop_description')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->unsignedBigInteger('gallery_id')->nullable();
 
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onUpdate('cascade')->onDelete('cascade');
        });
        
        Schema::create('shop_company', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('company_id');
            $table->string('shop_type');
            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('shop_id')->references('id')->on('shops')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['company_id', 'shop_id', 'shop_type', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
        Schema::dropIfExists('shop_company');
    }
}
