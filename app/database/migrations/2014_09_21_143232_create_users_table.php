<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            // basic columns
            $table->increments('id');
            $table->string('email');
            $table->string('password', 64);
            $table->unsignedInteger('role_id');

            // information columns
            $table->string('name', 60);
            $table->string('photo', 100)->nullable();
            $table->string('father_name', 60)->nullable();
            $table->string('mother_name', 60)->nullable();

            $table->date('birthdate')->nullable();
            $table->string('birthplace', 30)->nullable();
            $table->time('birthtime')->nullable();
            $table->string('height', 10)->nullable();

            $table->string('gotra', 20)->nullable();
            $table->string('vatan', 20)->nullable();
            $table->string('nakshtra', 20)->nullable();
            $table->string('nadi', 20)->nullable();
            $table->string('rashi', 20)->nullable();

            $table->string('permanent_address', 1024)->nullable();
            $table->string('primary_number', 15)->nullable();
            $table->string('secondary_address', 1024)->nullable();
            $table->string('secondary_number', 50)->nullable();

            $table->string('education', 100)->nullable();
            $table->string('hobbies', 256)->nullable();
            $table->string('job_description', 1024)->nullable();
            $table->string('salary', 20)->nullable();
            $table->string('references', 1024)->nullable();

            // admin related columns
            $table->boolean('approved')->default(false);
            $table->boolean('visibility')->default(false);

            // managed by Eloquent
            $table->timestamps();
            $table->string('remember_token', 100)->nullable();

            //indexes and constraints
            $table->unique('email');
            $table->foreign('role_id')->references('id')->on('roles');

        });

        // create the admin user
        $roleId = Role::where('name', 'admin')->pluck('id');
        Eloquent::unguard();
        User::create(array(
            'name' => 'admin',
            'email' => 'admin@random.com',
            'password' => Hash::make('fakepassword'),
            'role_id' => $roleId,
            'approved' => true
        ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

}
