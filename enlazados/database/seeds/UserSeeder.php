<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr = new User;
        $usr->name = 'Manuel';
        $usr->lastname = 'Lopez';
        $usr->documentnumber = '1054917';
        $usr->email = 'malg.nmg@hotmail.com';
        $usr->phone = 3502487845;
        $usr->birthdate = '1988/08/20';
        $usr->gender = 'Male';        
        $usr->password = bcrypt('123456');        
        $usr->save();

    }
}
