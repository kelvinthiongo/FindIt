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
            $table->string('tag')->nullable();
            $table->string('email')->unique();
            $table->string('slug')->nullable();
            $table->string('phone')->nullable();
            $table->string('type')->default('user');
            $table->boolean('is_verified')->default(false);
            $table->boolean('view')->default(true);
            $table->timestamp('email_verified_at')->default(now());
            $table->string('avatar')->default('uploads/users/avatar.png');
            $table->string('password')->default(bcrypt('@jkuat_lost'));
            $table->longText('api_token')->nullable();
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
