<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('categories')->delete();
           $categorias = [
            [
				'name'        => 'Impresora',
    		],
    		[
                'name'        => 'Notebook',
    		],
    		[
                'name'        => 'Desktop',
    		],
    		[
                'name'        => 'Impresora Termica',
    		],
    		[
                'name'        => 'Radios',
    		],
    		[
                'name'        => 'Celular',
            ],
            [
                'name'        => 'Tracker',
            ],
            [
                'name'        => 'Sin Categoria',    
    		]];
            DB::table('categories')->insert($categorias);
    

    DB::table('asignables')->delete();
            $asignables=[[
            'nama'        => 'Stock MCH',
            ],
            [
            'nama'        => 'Stock RP',
            ],
            [
            'nama'        => 'Stock CAM',
            ],
            [
            'nama'        => 'Stock USH',
            ],
            [
            'nama'        => 'Stock PAV',
            ],
            [
            'nama'        => 'Stock Arias',
            ]];
            DB::table('asignables')->insert($asignables);

    DB::table('estados')->delete();
        $estados=[ [
            'nama'        => 'Ingreso Nuevo',
            ],
            [
            'nama'        => 'Prestamo',
            ],
            [
            'nama'        => 'Cambio por Rotura',
            ],
            [
            'nama'        => 'Cambio por Renovacion',
            ],
            [
            'nama'        => 'Auditoria',
            ],
            [
            'nama'        => 'Stock',
            ],
            [
            'nama'        => 'Nuevo',
            ]];
            DB::table('estados')->insert($estados);



    }
}
