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
        Schema::create('exercises', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreignUuid('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->string('topic')->nullable();
            $table->text('note')->nullable();
            $table->string('file')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('is_submit')->default(false);
            $table->integer('mark')->nullable();
            $table->string('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
};
