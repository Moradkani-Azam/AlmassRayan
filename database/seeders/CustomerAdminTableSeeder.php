<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_admin')->insert(array(
            array('customer_id' => 2, 'admin_id' => 1),
            array('customer_id' => 4, 'admin_id' => 3),
            array('customer_id' => 5, 'admin_id' => 1),
        ));
    }
}
