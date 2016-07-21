<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            // columns
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamps();

            // indexes
            $table->unique('name');

        });

        Eloquent::unguard();
        Role::create(array('name' => 'admin'));
        Role::create(array('name' => 'user:male'));
        Role::create(array('name' => 'user:female'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }

}