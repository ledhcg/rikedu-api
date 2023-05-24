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
        Schema::create('results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreignUuid('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->integer('exam_1');
            $table->integer('exam_2');
            $table->integer('exam_3');
            $table->integer('active');
            $table->integer('final_exam');
            $table->string('review');
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
        Schema::dropIfExists('results');
    }
};
