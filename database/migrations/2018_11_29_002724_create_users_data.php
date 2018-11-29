<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \CodeEduUser\Models\User::create([
            'name' => config('codeeduuser.user_default.name'),
            'email' => config('codeeduuser.user_default.email'),
            'password' => bcrypt(config('codeeduuser.user_default.password')),
            'verified' => true
        ]);
        \Illuminate\Database\Eloquent\Model::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::disableForeignKeyConstraints();
        $user = \CodeEduUser\Models\User::where('email', 'admin@user.com')->first();
        $user->forceDelete();
        \Schema::enableForeignKeyConstraints();
    }
}
