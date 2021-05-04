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
            'name' => 'Oscar',
            'email' => 'gotiel.orm@gmail.com',
            'password' => bcrypt('qwerty123456'),
            'age' => 26,
            'username' => 'admin',
            'role_id' => 1,
            'surgery_id' => 1
        ]);
    }
}
