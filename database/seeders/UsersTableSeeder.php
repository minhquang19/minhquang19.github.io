<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        $limit = 10;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'name' => 'User0'.$i,
                'email' => 'User0'.$i.'@gmail.com',
                'phonenumber' => '0389769239',
                'address' => 'Bac Tu Liem Ha Noi',
                'password' =>'$2y$10$knCSzjh3iWmWiwxqY2e9h.EdQNecRfNLRMlTEXQ0KKPRJhahR8gve',
            ]);
        }
    }
}
