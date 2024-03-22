<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies'); // Assuming your company table is named 'companies'
            $table->string('job_title');
            $table->string('job_type');
            $table->string('job_category');
            $table->string('location');
            $table->string('email');
            $table->string('phone_number');
            $table->decimal('salary', 10, 2);
            $table->decimal('price_per_hour', 10, 2);
            $table->date('deadline');
            $table->text('job_details');
            $table->text('requirements');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
