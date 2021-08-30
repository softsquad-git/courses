<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserRerunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_reruns', function (Blueprint $table) {
            $table->dropColumn('txt');
            $table->dropColumn('txt_trans');
            $table->dropColumn('sound_file');
            $table->unsignedBigInteger('exercise_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_reruns', function (Blueprint $table) {
            //
        });
    }
}
