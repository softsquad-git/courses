<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDialogueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialogue', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_id')->index();
            $table->string('interlocutor_one_image');
            $table->string('interlocutor_two_image');
            $table->string('sound_file');
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
        Schema::dropIfExists('dialogue');
    }
}
