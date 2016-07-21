<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileStatusTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_status_types', function(Blueprint $table)
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
        ProfileStatusType::create(array('name' => 'NEW'));
        ProfileStatusType::create(array('name' => 'INCOMPLETE'));
        ProfileStatusType::create(array('name' => 'EDITED'));
        ProfileStatusType::create(array('name' => 'APPROVED'));
        ProfileStatusType::create(array('name' => 'DISAPPROVED'));
        ProfileStatusType::create(array('name' => 'DELETED'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_status_types');
    }

}
