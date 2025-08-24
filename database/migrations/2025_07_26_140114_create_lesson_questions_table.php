<?php

use App\Models\CourseLesson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lesson_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CourseLesson::class)->constrained('course_lessons')->cascadeOnDelete();
            $table->string('question_type');
            $table->string('passing_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_questions');
    }
};
