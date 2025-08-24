<?php

use App\Models\Course;
use App\Models\CourseCountry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('country_course', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CourseCountry::class)->constrained('course_countries')->cascadeOnDelete();
            $table->foreignIdFor(Course::class)->constrained('courses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_course');
    }
};
