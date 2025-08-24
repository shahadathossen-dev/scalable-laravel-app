<?php

use App\Models\LessonQuestion;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(LessonQuestion::class)->constrained('lesson_questions')->cascadeOnDelete();
            $table->boolean('current_state');
            $table->json('evaluation_data')->nullable();
            $table->json('analysis_data')->nullable();
            $table->double('score', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_scores');
    }
};
