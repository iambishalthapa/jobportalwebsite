<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_seeker_id')->constrained('job_seekers');
            $table->foreignId('job_id')->constrained('jobs');
            $table->foreignId('company_id')->constrained('companies');
            $table->string('resume_path');
            $table->string('cover_letter_path');
            $table->text('message')->nullable();
            $table->timestamps();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
        $table->dropColumn('status');
    }
};
