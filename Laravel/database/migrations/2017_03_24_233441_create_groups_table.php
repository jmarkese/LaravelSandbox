<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        return;

        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('group_id')
                ->unsigned()
                ->nullable()
                ->index();

            $table->integer('tree_id')
                ->unsigned()
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

            $table->integer('groupables_id')
                ->unsigned()
                ->nullable()
                ->index();

            $table->string('groupables_type')
                ->nullable()
                ->index();

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
        Schema::dropIfExists('groups');
    }
}
