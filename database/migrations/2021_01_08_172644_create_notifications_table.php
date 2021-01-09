<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()


    /* notification types :

         0 ->friendship request
         1 ->messager

        */

    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emitter')->references('id')->on('users');
            $table->foreignId('reciever')->references('id')->on('users');
            $table->integer('type');
            $table->text('content')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
