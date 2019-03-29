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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('slug');
            $table->string('phone')->nullable();
            // $table->boolean('supper')->default(0); //To be removed 
            $table->string('type')->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->default('uploads/users/avatar.png');
            $table->string('password')->default(bcrypt('@findit'));
            $table->softDeletes();
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
