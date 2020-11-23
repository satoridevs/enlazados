<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')-> insert([

            'name' => 'Admin',
            'description' => 'Administrador de la plataforma',            
            'created_at' => now()            

        ]);
        
        DB::table('roles')-> insert([

            'name' => 'Owner',
            'description' => 'Arrendatario de la propiedad',            
            'created_at' => now()           

        ]);

        DB::table('roles')-> insert([

            'name' => 'User',
            'description' => 'Usuario de la plataforma',            
            'created_at' => now()         

        ]);
                   

    }
}
