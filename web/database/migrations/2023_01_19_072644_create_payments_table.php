<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tournament_id');
            $table->bigInteger('gross_amount');
            $table->string('payment_link_id', 50)->nullable();
            $table->bigInteger('price');
            $table->bigInteger('quantity');
            $table->string('name', 225);
            $table->enum('status', [0, 1, 2])->default(0);
            $table->string('proof_of_payment', 225)->nullable();
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
        Schema::dropIfExists('payments');
    }
}