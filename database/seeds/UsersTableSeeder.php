<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = factory(\CodeEduUser\Models\User::class, 1)->states('author')->create();
        $roleAuthor = \CodeEduUser\Models\Role::where('name', config('codeedubook.acl.role_autor'))->first();
        $author->roles()->attach($roleAuthor);
    }
}
