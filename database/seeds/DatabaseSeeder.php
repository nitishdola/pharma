<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->insert(['name' => 'Pharma Admin', 'username' => 'admin', 'password' => bcrypt('password#')]);

        DB::table('companies')->insert(['name' => 'Arion Healthcare']);
        DB::table('companies')->insert(['name' => 'Oval Organic']);
        DB::table('companies')->insert(['name' => 'SAC Pharma']);
    }
}
