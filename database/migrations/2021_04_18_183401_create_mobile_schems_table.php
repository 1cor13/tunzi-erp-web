<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileSchemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_schems', function (Blueprint $table) {
            $table->id();
            $table->string('db_name');
            $table->integer('db_version')->default(1)->nullable();
            $table->boolean('db_encrypted')->default(false)->nullable();
            $table->string('db_mode')->default('full')->nullable();     // partial
            $table->longText('db_tables')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_schems');
    }
}
