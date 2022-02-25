<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->nullable();
            $table->string('ticket_subject');
            $table->string('priority')->nullable();
            $table->string('status')->nullable();
            $table->string('ticket_description')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')
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
        Schema::dropIfExists('tickets');
    }
}
