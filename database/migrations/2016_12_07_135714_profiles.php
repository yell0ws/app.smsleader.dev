<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('address')->nullable();
            $table->text('city')->nullable();
            $table->text('zip_code')->nullable();
            $table->string('pesel')->nullable();
            $table->string('nip')->nullable();
            $table->text('bank_name')->nullable();
            $table->string('bank_number')->nullable();
            $table->text('paypal_email')->nullable();
            $table->timestamp('updated_at')->nullableTimestamps();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::table('profiles', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
