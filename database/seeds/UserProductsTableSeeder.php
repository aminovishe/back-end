<?php

use Illuminate\Database\Seeder;

class UserProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\UserProduct::class,50)->create();
    }
}
