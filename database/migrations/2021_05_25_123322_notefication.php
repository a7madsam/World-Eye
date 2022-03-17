<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notefication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notefications', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('pictureID');
            $table->integer('visited')->default(0);
            $table->integer('commentID');
            $table->integer('type');
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notefication');
    }
}
