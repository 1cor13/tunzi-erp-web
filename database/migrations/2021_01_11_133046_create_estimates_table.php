<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->string('estimate_number')->nullable();
            $table->string('email')->unique();
            $table->string('client_address')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('estimate_date')->nullable();
            $table->string('expiry_date')->nullable();
            
            $table->string('item')->nullable();
            $table->text('description')->nullable();
            $table->string('unit_cost')->nullable();
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('discount')->nullable();
            $table->string('status')->nullable();
            
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('tax_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tax_id')->references('id')->on('taxes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimates');
    }
}
