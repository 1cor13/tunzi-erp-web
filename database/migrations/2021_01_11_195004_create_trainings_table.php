<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('training_cost')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('training_type_id')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->longText('other')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('training_type_id')->references('id')->on('training_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('trainers')->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
