<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_transaction_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('point_transaction_id')->unsigned();
            $table->integer('point_earned')->unsigned()->nullable();
            $table->integer('point_redeem')->unsigned()->nullable();
            $table->string('description', 150)->nullable();
            $table->timestamps();
            $table->foreign('point_transaction_id')->references('id')->on('point_transaction')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('point_transaction_detail', function (Blueprint $table) {
            //
        });
    }
}
