<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_type_name', 30);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->string('user_log', 30)->default('system');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_type', function (Blueprint $table) {
            //
        });
    }
}
