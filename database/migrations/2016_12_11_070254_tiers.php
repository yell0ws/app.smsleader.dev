<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('tiers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->decimal('mo5', 10, 2)->default(0);
            $table->decimal('mo9', 10, 2)->default(0);
            $table->decimal('mo14', 10, 2)->default(0);
            $table->decimal('mo19', 10, 2)->default(0);
            $table->decimal('mo20', 10, 2)->default(0);
            $table->decimal('mo25', 10, 2)->default(0);
            $table->decimal('mt4', 10, 2)->default(0);
            $table->decimal('mt5', 10, 2)->default(0);
            $table->decimal('mt19', 10, 2)->default(0);
            $table->timestamp('updated_at')->nullableTimestamps();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::table('tiers', function(Blueprint $table) {
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
        Schema::dropIfExists('tiers');
    }
}
