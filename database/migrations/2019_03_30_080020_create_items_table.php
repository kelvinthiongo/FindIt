<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('category_id')->nullable();
            $table->string('f_name');
            $table->string('s_name')->nullable();
            $table->string('l_name');
            $table->string('number');
            $table->string('image');
            $table->integer('user_id');
            $table->string('description')->nullable();
            $table->string('status');
            $table->string('place_found')->nullable();
            $table->string('place_to_get');
            $table->date('lf_date'); //date lost or found
            $table->integer('approved')->nullable(); // id for the admin who approved
            $table->integer('found')->nullable();//id for the user who marked it as found
            
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
        Schema::dropIfExists('items');
    }
}
