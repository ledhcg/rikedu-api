<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->integer('grade');
            $table->integer('teacher_quantity');
            $table->integer('room_quantity');
            $table->integer('week_lessons');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('subject_has_teacher', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignUuid('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });

        Schema::create('subject_has_room', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignUuid('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreignUuid('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('teacher_has_subject');
        Schema::dropIfExists('subject_has_room');

    }
};
