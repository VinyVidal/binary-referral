<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');

            $table->integer('level')->default(0); // 0 = nao indicado | 1 = primeiro indicado (lado esquerdo) | 2 = segundo indicado (lado direito)
            $table->integer('left_points')->default(0);
            $table->integer('right_points')->default(0);
            $table->foreignId('referrer_id')->nullable()->constrained('users'); // Usuário que indicou esta instancia de usuário

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
