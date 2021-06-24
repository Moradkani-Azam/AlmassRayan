<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = new color;
        $color->name = 'Green';
        $color->code = '#405943';
        $color->description = 'green';
        $color->save();

        $color1 = new color;
        $color1->name = 'White';
        $color1->code = '#e8ebe9';
        $color1->description = 'white';
        $color1->save();

        $color2 = new color;
        $color2->name = 'Red';
        $color2->code = '#a88a93';
        $color2->description = 'red';
        $color2->save();
    }
}
