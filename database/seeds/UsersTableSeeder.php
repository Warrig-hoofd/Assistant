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
        $data['name']     = 'Tim Joosten';
        $data['email']    = 'Topairy@gmail.com';
        $data['password'] = bcrypt('root');

        $table = DB::table('users');
        $table->delete();
        $table->insert($data);

    }
}
