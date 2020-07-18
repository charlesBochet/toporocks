<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->point('location');
            $table->integer('author_id');
            $table->integer('score')->default(0);
        });

        Schema::create('ascents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('comment')->nullable();
            $table->string('grade');
            $table->integer('route_id');
            $table->integer('author_id');
            $table->integer('picture_id');
            $table->integer('score')->default(0);
        });

        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('picture_path');
            $table->string('traced_picture_path');
            $table->integer('route_id');
            $table->integer('score')->default(0);
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('video_path');
            $table->integer('route_id');
            $table->integer('ascent_id');
            $table->integer('score')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
        Schema::dropIfExists('pictures');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('ascents');
    }
}
