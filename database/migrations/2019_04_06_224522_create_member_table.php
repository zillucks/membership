<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('identity_id')->unsigned();
            $table->integer('member_type_id')->unsigned()->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->bigInteger('referral_id')->unsigned()->nullable();
            $table->string('member_code', 10)->unique();
            $table->string('referral_code', 10)->unique()->nullable();
            $table->date('registration_date');
            $table->integer('current_point')->unsigned()->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->string('user_log', 30)->default('system');
            $table->foreign('identity_id')->references('id')->on('identity')->onDelete('cascade');
            $table->foreign('referral_id')->references('id')->on('member')->onDelete('set null');
            $table->foreign('member_type_id')->references('id')->on('member_type')->onDelete('set null');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member', function (Blueprint $table) {
            //
        });
    }
}
