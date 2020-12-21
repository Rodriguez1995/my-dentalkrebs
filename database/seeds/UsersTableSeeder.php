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
        'role' => 'admin'
    	]);

        User::create([
        'name' => 'Paciente Test',
        'lastname' => 'Rodriguez Cordero',
        'email' => 'patient@hotmail.com',
        'password' => bcrypt('12345678'),
        'dni' => '06187738',
        'role' => 'patient'
        ]);

        User::create([
        'name' => 'Médico Test',
        'lastname' => 'Rodriguez Cordero',
        'email' => 'doctor@hotmail.com',
        'password' => bcrypt('12345678'),
        'dni' => '661843738',
        'role' => 'doctor'
        ]);
        factory(User::class, 50)->states('patient')->create();
    }
}
