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
            $table->dropColumn('banned');
            $table->dropColumn('test_kontrolny');
            $table->dropColumn('last_ip');
            $table->dropColumn('user_agent');
            $table->dropColumn('odpowiedzi');
            $table->dropColumn('czas');
        });
        Schema::table('uczestnicy', function (Blueprint $table) {
            $table->boolean('banned')->default(false);
            $table->boolean('test_kontrolny')->default(false);
            $table->string('last_ip')->default('');
            $table->string('user_agent')->default('');
            $table->string('odpowiedzi')->default('[]');
            $table->integer('czas')->default(0);
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
            $table->dropColumn('banned');
            $table->dropColumn('test_kontrolny');
            $table->dropColumn('last_ip');
            $table->dropColumn('user_agent');
            $table->dropColumn('odpowiedzi');
            $table->dropColumn('czas');
        });
        Schema::table('uczestnicy', function (Blueprint $table) {
            $table->boolean('banned');
            $table->boolean('test_kontrolny');
            $table->string('last_ip');
            $table->string('user_agent');
            $table->string('odpowiedzi');
            $table->integer('czas');
        });
    }
}
