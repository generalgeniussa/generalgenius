<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyName');
            $table->string('contactName');
            $table->string('contactNumber');
            $table->string('emailAddress');
            $table->text('description');
            $table->integer('capturedBy')->unsigned();
            $table->foreign('capturedBy')->references('id')->on('users');
            $table->string('status')->default('Pending');
            $table->integer('meeting_id')->default(0);
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
        Schema::dropIfExists('leads');
    }
}
