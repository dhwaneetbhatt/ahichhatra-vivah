<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileStatusTypeId extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            // add status_type_id as foreign key to profile_status_types
            $table->unsignedInteger('status_type_id')
                  ->default(ProfileStatusType::where('name', 'NEW')->pluck('id'))
                  ->after('role_id');

            $table->foreign('status_type_id')->references('id')->on('profile_status_types');

            // drop the older columns
            $table->dropColumn(array('approved', 'visibility'));
        });

        // set the default visibility of default user to APPROVED
        $admin = User::where('email', 'admin@random.com')->firstOrFail();
        $statusTypeId = ProfileStatusType::where('name', 'APPROVED')->pluck('id');
        $admin->status_type_id = $statusTypeId;
        $admin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            // drop the new column
            $table->dropColumn(array('status_type_id'));

            // re-create the columns
            $table->boolean('approved')->default(false);
            $table->boolean('visibility')->default(false);
        });
    }

}
