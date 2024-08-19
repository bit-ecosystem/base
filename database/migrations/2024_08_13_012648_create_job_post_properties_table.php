<?php

use App\Models\JobPost;
use App\Models\JobPostProperty;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(JobPost::class,'reports_to_id')->nullable();
            $table->timestamps();
        });
        Schema::create('job_post_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->foreignIdFor(JobPost::class)->nullable();
            $table->foreignIdFor(JobPostProperty::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_properties');
        Schema::dropIfExists('job_posts');
    }
};
