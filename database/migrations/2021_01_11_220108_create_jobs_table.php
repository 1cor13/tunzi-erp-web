<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title')->nullable();
            $table->string('job_location')->nullable();
            $table->string('num_of_vacancies')->nullable();
            $table->string('experience')->nullable();
            $table->string('age')->nullable();
            $table->string('salary_from')->nullable();
            $table->string('salary_to')->nullable();
            $table->string('start_date')->nullable();
            $table->string('expired_date')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('job_type_id')->nullable();
            $table->unsignedBigInteger('job_applicant_id')->nullable();
            $table->longText('other')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_type_id')->references('id')->on('job_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_applicant_id')->references('id')->on('job_applicants')
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
        Schema::dropIfExists('jobs');
    }
}
