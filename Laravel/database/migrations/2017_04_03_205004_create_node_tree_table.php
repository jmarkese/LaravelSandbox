<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->integer('tree_id')
                ->unsigned()
                ->index();

            $table->integer('parent_id')
                ->unsigned()
                ->nullable()
                ->index();

            $table->integer('numer')
                ->unsigned()
                ->index();

            $table->integer('denom')
                ->unsigned()
                ->index();

            $table->bigInteger('interval_l')
                ->unsigned()
                ->index();

            $table->bigInteger('interval_r')
                ->unsigned()
                ->index();

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
        Schema::dropIfExists('nodes');
    }
}
