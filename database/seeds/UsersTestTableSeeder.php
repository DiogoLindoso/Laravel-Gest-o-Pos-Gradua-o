<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Admin;
class UsersTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['email'=>'diogolindoso@gmail.com', 'password'=>bcrypt('diogo123')]);
        Admin::firstOrCreate(['name'=>'Admin', 'email'=>'diogolindoso@gmail.com', 'password'=>bcrypt('diogo123')]);
    }
}
