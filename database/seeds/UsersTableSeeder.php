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
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Stefan Babic',
            'email' => 'stefanbabicbg@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
