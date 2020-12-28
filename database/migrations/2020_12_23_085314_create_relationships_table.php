<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*** status codes

        0	Pending
        1	Accepted
        2	Declined
        3	Blocked

         **/

        /*

         Action user id -> id of the user who has performed the most recent status field update
         eg : user 1 sending request to user 2 -> action user id will be 1

         */

        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_one_id')->references('id')->on('users');
            $table->foreignId('user_two_id')->references('id')->on('users');
            $table->unique(['user_one_id', 'user_two_id']);
            $table->unsignedTinyInteger('status');
            $table->integer('action_user_id');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
