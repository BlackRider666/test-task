<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpizodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epizods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sezon_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('logo_path');
            $table->text('desc');
            $table->date('release');
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
        Schema::dropIfExists('epizods');
    }
}
