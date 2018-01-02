<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'name' => 'Wladimir',
           'email' => 'wladimir@gmail.com',
           'password' => bcrypt('123456'),
        ]);
        User::create([
           'name' => 'Maria',
           'email' => 'maria@gmail.com',
           'password' => bcrypt('123456'),
        ]);
    }
}
