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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->default('avatar_default.png');
            $table->string('bio')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('date_of_birth');
            $table->string('phone');
            $table->string('address');
            $table->string('department');
            $table->boolean('active')->default(false);
            $table->timestamp('last_login')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('parent_has_student', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->timestamps();

            $table->foreignUuid('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('student_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('parent_has_student');
    }
};
