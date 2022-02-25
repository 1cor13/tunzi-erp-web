<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->string('country_code')->nullable();
            $table->string('short_code')->nullable();
            $table->string('country_region')->nullable();
            $table->string('country_timezone')->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->longText('other')->nullable();
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
        Schema::dropIfExists('countries');
    }
}
