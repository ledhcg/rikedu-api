<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('post_has_category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table
                ->foreignUuid('category_id')
                ->references('id')
                ->on('categories');
            $table
                ->foreignUuid('post_id')
                ->references('id')
                ->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('post_has_category');
    }
};
