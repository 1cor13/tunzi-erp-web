<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('purchase_from')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('supplier')->nullable();
            $table->string('condition')->nullable();
            $table->string('warranty')->nullable();
            $table->string('value')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
