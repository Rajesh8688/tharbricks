<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name' => 'Rajesh Vuppala',
               'first_name' => 'Rajesh',
               'last_name' => 'vuppala',
               'email'=>'rajesh@tharbricks.com',
                'back_end_user'=>1,
               'password'=> bcrypt('Rajesh@123'),
            ],
            [
                'name'=>'Rajesh Vuppala frontEnd',
                'first_name' => 'Rajesh',
               'last_name' => 'vuppala',
                'email'=>'vuppalaRajesh961@gmail.com',
                 'back_end_user'=>0,
                'password'=> bcrypt('Rajesh@123'),
             ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
