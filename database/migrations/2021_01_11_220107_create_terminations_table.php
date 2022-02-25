<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminations', function (Blueprint $table) {
            $table->id();
            $table->string('termination_date')->nullable();
            $table->string('termination_reason')->nullable();
            $table->string('notice_date')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('termination_type_id')->nullable();
            $table->longText('other')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('termination_type_id')->references('id')->on('termination_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terminations');
    }
}
