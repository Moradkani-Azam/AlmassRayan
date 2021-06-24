<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wood_Material;

class WoodMaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $woode_material = new Wood_Material;
        $woode_material->name = 'MDF';
        $woode_material->description = 'MDF';
        $woode_material->save();

        $woode_material1 = new Wood_Material;
        $woode_material1->name = 'Pine';
        $woode_material1->description = 'Pine';
        $woode_material1->save();

        $woode_material2 = new Wood_Material;
        $woode_material2->name = 'Aspen';
        $woode_material2->description = 'Aspen';
        $woode_material2->save();
    }
}
