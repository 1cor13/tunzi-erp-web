<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('promotion_date')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->longText('other')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
