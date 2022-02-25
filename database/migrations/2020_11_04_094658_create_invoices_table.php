<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->string('invoice_number')->nullable();
            $table->date('due_date');
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->text('notes')->nullable();
            $table->text('footer')->nullable();
            $table->string('recurring')->nullable();
            $table->string('attachment')->nullable();
            $table->string('status')->nullable();
            
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
