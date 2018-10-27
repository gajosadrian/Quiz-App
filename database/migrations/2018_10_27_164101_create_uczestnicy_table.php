<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUczestnicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uczestnicy', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('banned');
            $table->string('nazwa');
            $table->timestamp('data_rozpoczecia_testu')->nullable();
            $table->timestamp('data_zakonczenia_testu')->nullable();
            $table->boolean('test_kontrolny');
            $table->ipAddress('last_ip');
            $table->string('user_agent');
            $table->timestamp('data_ostatniego_logowania')->nullable();
            $table->string('odpowiedzi');
            $table->string('czas');
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
        Schema::dropIfExists('uczestnicy');
    }
}
