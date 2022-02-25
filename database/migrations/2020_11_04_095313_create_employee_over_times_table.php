<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeOverTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_over_times', function (Blueprint $table) {
            $table->id();
            $table->string('overtime_date');
            $table->string('overtime_hours')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('employee_over_times');
    }
}
