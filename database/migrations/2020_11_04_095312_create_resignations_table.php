<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resignations', function (Blueprint $table) {
            $table->id();
            $table->string('notice_date')->nullable();
            $table->string('resignation_date')->nullable();
            $table->string('resignation_reason')->nullable();

            $table->unsignedBigInteger('employee_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('resignations');
    }
}
