<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id')->unsigned();
            $table->string('invoice_number', 12)->unique();
            $table->date('invoice_date');
            $table->string('description', 150)->nullable();
            $table->enum('transaction_status', ['process', 'confirmed', 'rejected', 'canceled'])->default('process');
            $table->timestamps();
            $table->softDeletes();
            $table->string('user_log', 30)->default('system');
            $table->foreign('member_id')->references('id')->on('member')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('point_transaction', function (Blueprint $table) {
            //
        });
    }
}
