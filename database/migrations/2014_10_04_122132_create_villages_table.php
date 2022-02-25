<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sub_county_id')->unsigned()->index();
            $table->string('village_name');
            $table->string('village_code')->nullable();
            $table->string('village_status')->default('available')->nullable();
            $table->longText('other')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sub_county_id')->references('id')->on('sub_counties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villages');
    }
}
