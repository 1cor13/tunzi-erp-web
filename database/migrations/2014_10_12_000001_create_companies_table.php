<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->unsignedBigInteger('village_id')->nullable()->index();
            $table->unsignedBigInteger('language_id')->nullable()->index();
            $table->unsignedBigInteger('gallery_id')->nullable()->index();
            $table->string('other_languages')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
