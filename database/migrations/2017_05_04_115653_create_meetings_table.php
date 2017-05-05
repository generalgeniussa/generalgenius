<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->default('');
            $table->text('description');
            $table->dateTime('time');
            $table->text('meetingAddress');
            $table->string('clientName', 255)->default('');
            $table->string('clientContactNumber', 255)->default('');
            $table->string('clientEmailAddress', 255)->default('');
            $table->integer('createdBy')->unsigned();
            $table->integer('attendingGenius')->unsigned();;
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->foreign('createdBy')->references('id')->on('users');
            $table->foreign('attendingGenius')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
