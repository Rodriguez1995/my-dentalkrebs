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
    	'name' => 'Giancarlo Felipe',
        'lastname' => 'Rodriguez Cordero',
        'email' => 'Grodriguez1905@hotmail.com',
        'password' => bcrypt('12345678'),
        'dni' => '76187738',
        'address' => '',
        'phone' => '',
        'role' => 'admin'
    	]);
        factory(User::class, 50)->create();
    }
}
