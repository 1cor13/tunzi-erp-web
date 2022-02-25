<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('joining_date')->nullable();
            $table->string('employee_phone')->nullable();

            
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('employee_holiday_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('employee_holiday_id')->references('id')->on('employee_holidays')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
