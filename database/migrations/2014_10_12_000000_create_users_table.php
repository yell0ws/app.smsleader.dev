<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 32)->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->decimal('balance', 10, 2)->default(0);
            $table->string('referral_id', 10);
            $table->string('referral', 10)->nullable();
            $table->integer('referral_provision')->default(5);
            $table->boolean('admin')->default(false);
            $table->boolean('active')->default(false);
            $table->boolean('ban')->default(false);
            $table->string('reset_token', 64)->nullable();
            $table->rememberToken();
            $table->timestamp('reset_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
