<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->string('nationality_name');
            $table->string('nationality_code');
            $table->text('description')->nullable();
            $table->string('status');
            $table->softDeletes();
            $table->longText('other')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationalities');
    }
}
