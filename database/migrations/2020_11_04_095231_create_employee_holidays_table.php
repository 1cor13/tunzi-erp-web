<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_holidays', function (Blueprint $table) {
            $table->id();
            $table->string('holiday_name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('employee_holidays');
    }
}
