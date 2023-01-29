<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_tournaments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('club_id');
            $table->bigInteger('tournament_id');
            $table->bigInteger('payment_id')->nullable();
            $table->string('name');
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->boolean('status');
            $table->enum('paid_state', [1, 2, 3]);
            $table->boolean('published')->default(0);
            $table->text('proof_of_payment')->nullable();
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
        Schema::dropIfExists('register_tournaments');
    }
}