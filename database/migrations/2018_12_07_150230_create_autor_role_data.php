<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use CodeEduUser\Models\Role;

class CreateAutorRoleData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create([
            'name' => config('codeedubook.acl.role_autor'),
            'description' => 'Papel de usuário de autor'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAutor = Role::where('name', 'Autor')->first();
        $roleAutor->permissions()->detach();
        $roleAutor->users()->detach();
        $roleAutor->delete();
    }
}
