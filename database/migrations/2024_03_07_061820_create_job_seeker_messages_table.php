<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('job_seeker_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_seeker_id')->constrained('job_seekers');
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('application_id')->constrained('applications');
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_seeker_messages');
    }
}
