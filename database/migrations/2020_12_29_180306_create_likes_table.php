<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('likeable_id');
            $table->string('likeable_type'); // App\Models\Post or App\Models\Comment
            $table->foreignId('user_id')->references('id')->on('users');
            $table->unique(['likeable_id', 'likeable_type', 'user_id']);
            $table->boolean('like')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
