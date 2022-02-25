<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->bigInteger('message_id')->unsigned()->index()->nullable();
            $table->bigInteger('sender_id')->unsigned();
            $table->bigInteger('receiver_id')->unsigned();
            $table->string('folder')->nullable()->default('inbox');
            $table->string('title')->nullable();
            $table->text('message');
            $table->string('priority')->default('unseen')->nullable();
            $table->string('visibility')->nullable();
            $table->boolean('feature')->nullable();
            $table->string('status')->nullable()->default('pending-payment');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
