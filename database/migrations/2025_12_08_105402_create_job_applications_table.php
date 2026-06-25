<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_applications')) {
            Schema::create('job_applications', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('career_id');
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->string('resume_path');
                $table->timestamps();
                
                $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');
            });
        } else {
            // Table exists, check and add missing columns
            Schema::table('job_applications', function (Blueprint $table) {
                if (!Schema::hasColumn('job_applications', 'career_id')) {
                    $table->unsignedBigInteger('career_id')->after('id');
                }
                if (!Schema::hasColumn('job_applications', 'name')) {
                    $table->string('name')->after('career_id');
                }
                if (!Schema::hasColumn('job_applications', 'email')) {
                    $table->string('email')->after('name');
                }
                if (!Schema::hasColumn('job_applications', 'phone')) {
                    $table->string('phone')->after('email');
                }
                if (!Schema::hasColumn('job_applications', 'resume_path')) {
                    $table->string('resume_path')->after('phone');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}
