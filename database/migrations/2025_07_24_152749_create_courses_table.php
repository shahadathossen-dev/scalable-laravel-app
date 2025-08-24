<?php

use App\Models\CourseLanguage;
use App\Models\CourseStandard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->longText('description');
            $table->foreignIdFor(CourseLanguage::class)->constrained('course_languages')->cascadeOnDelete();
            $table->foreignIdFor(CourseStandard::class)->constrained('course_standards')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
