<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RegisterLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        if(User::exists()){
            return true;
        }
        $user=User::create([
            'name'=>'Random Lab',
            'email'=>'admin@randomlab.com',
            'password'=>\Hash::make('123456')
        ]);

        $token = $user->createToken('API TOKEN');

    }
}
