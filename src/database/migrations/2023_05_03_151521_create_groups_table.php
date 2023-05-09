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
        Schema::create('groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->integer('grade');
            $table->string('time');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('group_has_teacher', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignUuid('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreignUuid('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('group_has_student', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignUuid('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreignUuid('student_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('group_has_room', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignUuid('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreignUuid('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_has_teacher');
        Schema::dropIfExists('group_has_student');
        Schema::dropIfExists('group_has_room');
    }
};
