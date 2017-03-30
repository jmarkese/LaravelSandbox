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
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('parent_id')
                ->unsigned()
                ->nullable()
                ->index();

            $table->string('name')
                ->nullable();

            $table->integer('numer_l')
                ->nullable()
                ->unsigned();

            $table->integer('denom_l')
                ->nullable()
                ->unsigned();

            $table->integer('numer_r')
                ->nullable()
                ->unsigned();

            $table->integer('denom_r')
                ->nullable()
                ->unsigned();

            $table->bigInteger('interval')
                ->nullable()
                ->unsigned()
                ->index();

            $table->integer('groupables_id')
                ->unsigned()
                ->nullable()
                ->index();

            $table->string('groupables_type')
                ->nullable()
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
        Schema::dropIfExists('groups');
    }
}
