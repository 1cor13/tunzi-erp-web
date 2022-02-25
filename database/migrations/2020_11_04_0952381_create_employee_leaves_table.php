<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('number_of_days')->nullable();
            $table->string('remaining_leaves')->nullable();
            $table->text('leave_reason')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('employee_leave_type_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_leave_type_id')->references('id')->on('employee_leave_types')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('employee_leaves');
    }
}
