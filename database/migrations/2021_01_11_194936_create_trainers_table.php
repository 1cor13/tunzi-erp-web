<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('role')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->longText('other')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainers');
    }
}
