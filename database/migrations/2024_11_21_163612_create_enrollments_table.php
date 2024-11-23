<?php

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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->date('enroll_date');
            // secara default, statusnya active,
            // status = cancel, kalau misalnya cancel enrollment
            // status = finished, kalau misalnya udah tamatkan course
            // status = suspended, kalau misalnya student lagi jeda
            $table->string('status')->default('Active');
            $table->double('grade')->nullable(); // nilai akhir untuk course yg dienroll oleh student
            $table->timestamps();
            $table->unique(['course_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
