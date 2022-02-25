<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('store_phone')->nullable();
            $table->string('store_email')->nullable();
            $table->string('time_open')->nullable();
            $table->string('time_closed')->nullable();
            $table->string('store_whatsapp')->nullable();
            $table->string('store_facebook')->nullable();
            $table->string('store_twitter')->nullable();
            $table->string('store_instagram')->nullable();

            $table->string('store_lat')->nullable();
            $table->string('store_long')->nullable();

            $table->text('store_description')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->unsignedBigInteger('gallery_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('store_company', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('company_id');
            $table->string('store_type')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('store_id')->references('id')->on('stores')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['company_id', 'store_id', 'store_type', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
        Schema::dropIfExists('store_company');
    }
}
