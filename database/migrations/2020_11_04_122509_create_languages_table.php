<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->string('language_name');
            $table->text('language_description')->nullable();
            $table->string('status')->nullable()->default('available');
            $table->softDeletes();
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
        Schema::dropIfExists('languages');
    }
}
