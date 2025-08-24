<?php

use App\Models\LessonQuestion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answer_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LessonQuestion::class)->constrained('lesson_questions')->cascadeOnDelete();
            $table->string('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_contents');
    }
};
