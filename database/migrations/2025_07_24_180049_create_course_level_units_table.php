<?php

use App\Models\CourseLevel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_level_units', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CourseLevel::class)->constrained('course_levels')->cascadeOnDelete();
            $table->string('name')->index();
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_level_units');
    }
};
