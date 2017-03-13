<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Magentables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magentables', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('magenta_id')
                ->unsigned()
                ->index();

            $table->integer('magentables_id')
                ->unsigned()
                ->index();

            $table->string('magentables_type')
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('magentables');
    }
}

