<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUczestnicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uczestnicy', function (Blueprint $table) {
            $table->dropColumn('czas');
        });
        Schema::table('uczestnicy', function (Blueprint $table) {
            $table->integer('czas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uczestnicy', function (Blueprint $table) {
            $table->dropColumn('czas');
        });
        Schema::table('uczestnicy', function (Blueprint $table) {
            $table->string('czas');
        });
    }
}
