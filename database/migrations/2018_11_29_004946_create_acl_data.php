<?php

use CodeEduUser\Models\Role;
use CodeEduUser\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::create([
            'name' => config('codeeduuser.acl.role_admin'),
            'description' => 'Papel de usuário mestre do sistema'
        ]);

        $user = User::where('email', config('codeeduuser.user_default.email'))->first();
        $user->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAdmin = Role::where('name', 'Admin')->first();
        $user = User::where('email', config('codeeduuser.user_default.email'))->first();
        $user->roles()->detach($roleAdmin->id);

        $roleAdmin->delete();
    }
}
