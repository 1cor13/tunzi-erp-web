<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_name');
            $table->string('policy_description')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('department_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')
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
        Schema::dropIfExists('policies');
    }
}
