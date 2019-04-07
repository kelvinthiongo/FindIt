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
            
            $table->integer('category_id');
            $table->string('f_name')->nullable();
            $table->string('s_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('slug')->default(str_slug(date('Y-m-d H:i:s')));
            $table->string('number');
            $table->string('image')->default("[\"uploads\\\/items\\\/image.png\"]");
            $table->integer('user_id');
            $table->integer('reports')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default('found');
            $table->string('place_found')->nullable();
            $table->string('place_to_get');
            $table->date('lf_date')->default(date('Y-m-d H:i:s')); //date lost or found
            $table->integer('approved')->nullable(); // id for the admin who approved
            $table->integer('resolved')->nullable();//id for the user who marked it as found
            $table->softDeletes();
            
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
