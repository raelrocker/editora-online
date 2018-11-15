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
        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'admin@editora.com'
        ]);
        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'author@editora.com'
        ]);
    }
}
