<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->date('bill_date');
            $table->string('bill_number')->nullable();
            $table->date('due_date');
            $table->string('order_number')->nullable();
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->text('notes')->nullable();
            $table->string('recurring')->nullable();
            $table->string('attachment')->nullable();
            $table->string('status')->nullable();
            
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
