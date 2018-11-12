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
            $table->dropColumn('odpowiedzi');
        });
        Schema::table('uczestnicy', function (Blueprint $table) {
            $table->string('odpowiedzi', 500);
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
            $table->dropColumn('odpowiedzi');
        });
        Schema::table('uczestnicy', function (Blueprint $table) {
            $table->string('odpowiedzi', 600)->default('[]');
        });
    }
}
