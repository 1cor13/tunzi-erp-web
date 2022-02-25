<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->rememberToken();

            $table->string('prefix')->unique()->nullable();
            $table->string('source')->nullable()->default('web');
            $table->string('username')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->text('occupation')->nullable();

            $table->unsignedBigInteger('gallery_id')->nullable();
            $table->bigInteger('gender_id')->unsigned()->index()->nullable();
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            
            $table->date('date_of_birth')->nullable();
            $table->string('account_no')->nullable()->unique();
            $table->string('image_path')->nullable();
            $table->string('image_type')->nullable()->default('default');
            $table->text('bio')->nullable();
            $table->boolean('receive_messages')->nullable()->default(true);
            $table->boolean('account_auth')->nullable()->default(true);
            $table->boolean('email_notifications')->nullable()->default(true);
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('status')->nullable();
            $table->longText('other')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
