<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('url');
            $table->string('image');
            $table->string('source_code_link')->nullable();
            $table->string('cpanel_username')->nullable();
            $table->string('cpanel_password')->nullable();
            $table->string('admin_username')->nullable();
            $table->string('admin_password')->nullable();
            $table->string('phone')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
