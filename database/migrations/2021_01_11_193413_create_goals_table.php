<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('target_achievement');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('goal_type_id')->nullable();
            $table->longText('other')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('goal_type_id')->references('id')->on('goal_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goals');
    }
}
