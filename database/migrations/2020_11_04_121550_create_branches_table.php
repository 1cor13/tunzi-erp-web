<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->string('branch_code')->unique();
            $table->string('branch_email')->nullable();
            $table->string('branch_phone2')->nullable();
            $table->text('branch_description')->nullable();
            $table->string('branch_street')->nullable();
            $table->string('open_hours')->nullable();
            $table->string('gps_lat')->nullable();
            $table->string('gps_long')->nullable();
            $table->string('branch_status')->default('open');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('gallery_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('branches');
    }
}
