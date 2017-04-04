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

            $table->integer('parent_id')
                ->unsigned()
                ->nullable()
                ->index();

            $table->string('name');

            $table->integer('numer')
                ->unsigned();

            $table->integer('denom')
                ->unsigned();

            $table->bigInteger('interval_l')
                ->unsigned();

            $table->bigInteger('interval_r')
                ->unsigned();

            $table->timestamps();

            $table->unique(['numer', 'denom']);

            $table->unique(['interval_l', 'interval_r']);
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
