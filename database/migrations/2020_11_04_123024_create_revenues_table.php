<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('amount')->nullable();
            $table->text('description')->nullable();
            $table->string('recurring')->nullable();
            $table->string('pay_method')->nullable();
            $table->string('reference')->nullable();
            $table->string('attachment')->nullable();

            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revenues');
    }
}
