<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('rate')->nullable();
            $table->string('priority')->nullable();
            $table->string('project_leader')->nullable();
            $table->string('project_team')->nullable();
            $table->string('project_description')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('customer_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')
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
        Schema::dropIfExists('projects');
    }
}
