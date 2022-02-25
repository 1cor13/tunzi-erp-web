<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->bigInteger('district_id')->unsigned()->index()->nullable();
            $table->bigInteger('gallery_id')->unsigned()->index()->nullable();
            $table->bigInteger('major_partner')->unsigned()->index()->nullable();
            $table->string('partner_id')->nullable();
            $table->string('partner_type')->default('private')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('open_hours')->nullable();
            $table->string('gps_lat')->nullable();
            $table->string('gps_long')->nullable();
            $table->string('category')->nullable()->default('hospital');
            $table->string('status')->default('active');
            $table->timestamps();

            $table->foreign('major_partner')->references('id')->on('partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
