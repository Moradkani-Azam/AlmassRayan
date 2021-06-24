<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = 'Admin Name';
        $admin->email = 'Admin.Name@gmail.com';
        $admin->password = bcrypt('12345678');
        $admin->role_id = Role::where('name', 'admin')->first()->id;
        $admin->save();

        $user = new User;
        $user->name = 'Customer Name';
        $user->email = 'Customer.Name@gmail.com';
        $user->password = bcrypt('12345678');
        $user->role_id = Role::where('name', 'customer')->first()->id;
        $user->save();

        $admin2 = new User;
        $admin2->name = ' Second Admin Name';
        $admin2->email = 'SecondAdmin.Name@gmail.com';
        $admin2->password = bcrypt('12345678');
        $admin2->role_id = Role::where('name', 'admin')->first()->id;
        $admin2->save();

        $user2 = new User;
        $user2->name = 'Second Customer Name';
        $user2->email = 'SecondCustomer.Name@gmail.com';
        $user2->password = bcrypt('12345678');
        $user2->role_id = Role::where('name', 'customer')->first()->id;
        $user2->save();

        $user3 = new User;
        $user3->name = 'Other Customer Name';
        $user3->email = 'OtherCustomer.Name@gmail.com';
        $user3->password = bcrypt('12345678');
        $user3->role_id = Role::where('name', 'customer')->first()->id;
        $user3->save();
    }
}
