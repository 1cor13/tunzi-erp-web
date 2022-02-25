<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTimeSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_time_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('deadline');
            $table->string('total_hours')->nullable();
            $table->string('remaining_hours')->nullable();
            $table->string('timesheet_date')->nullable();
            $table->string('timesheet_hours')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
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
        Schema::dropIfExists('employee_time_sheets');
    }
}
