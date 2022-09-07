<?php

namespace Database\Seeders;

use App\Models\Alergeno;
use App\Models\Ingrediente;
use App\Models\Plato;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //creo alérgenos
        //https://curso-alergenos.com/lecciones/los-14-alergenos-principales/
        Alergeno::create(['id' => 1, 'nombre' => 'Gluten']);
        Alergeno::create(['id' => 2, 'nombre' => 'Crustáceos']);
        Alergeno::create(['id' => 3, 'nombre' => 'Huevos']);
        Alergeno::create(['id' => 4, 'nombre' => 'Pescados']);
        Alergeno::create(['id' => 5, 'nombre' => 'Cacahuetes']);
        Alergeno::create(['id' => 6, 'nombre' => 'Soja']);
        Alergeno::create(['id' => 7, 'nombre' => 'Lácteos']);
        Alergeno::create(['id' => 8, 'nombre' => 'Frutos con cáscara']);
        Alergeno::create(['id' => 9, 'nombre' => 'Apio']);
        Alergeno::create(['id' => 10, 'nombre' => 'Mostaza']);
        Alergeno::create(['id' => 11, 'nombre' => 'Sésamo']);
        Alergeno::create(['id' => 12, 'nombre' => 'Sulfitos']);
        Alergeno::create(['id' => 13, 'nombre' => 'Altramuces']);
        Alergeno::create(['id' => 14, 'nombre' => 'Moluscos']);

        //creo ingredientes
        $ingredientes = [];
        $ingredientes100m = require ('100montaditos-ingredientes.php');
        foreach ($ingredientes100m as $ingrediente){

            //creo el ingrediente
            $model = Ingrediente::create(['nombre' => $ingrediente['nombre']]);

            //me guardo array de ingredientes para poder buscar después en los productos
            $ingredientes[$model->id] = $ingrediente['nombre'];

            //guardo alérgenos de este ingrediente
            $alergenos = [];
            //$this->command->info('Ingrediente ... '.$ingrediente['nombre']);
            for($x = 1; $x<=14; $x++){
                if($ingrediente['val'.$x]){
                    $alergenos[] = $x;
                }
            }
            if($alergenos){
                $model->alergenos()->attach($alergenos);
            }
        }

        //creo productos
        $productos100m = require ('100montaditos-productos.php');
        foreach ($productos100m as $producto){

            $nombre = $producto['nombre'];

            //creo el producto
            $plato = Plato::create(['id' => $producto['id'],'nombre' => $nombre]);

            //guardo ingredientes de este producto
            $los_ingredientes = [];
            foreach ($ingredientes as $i_id => $i_nombre){
                if(Str::contains($nombre,$i_nombre, true)){
                    $los_ingredientes[] = $i_id;
                }
            }
            if($los_ingredientes){
                $plato->ingredientes()->attach($los_ingredientes);
            }else{
                $this->command->warn('¿El producto '.$nombre.' no tiene ingredientes 😲?');
            }
        }

    }
}
