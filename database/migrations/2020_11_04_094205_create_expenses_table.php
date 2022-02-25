<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('item_name')->nullable();
            $table->string('purchase_from')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('paid_by')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('customer_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
