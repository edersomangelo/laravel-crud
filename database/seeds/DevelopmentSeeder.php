<?php

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        factory(\App\User::class,5)->create();
        factory(\App\Companies::class,15)->create();
        factory(\App\Employees::class,50)->create();
    }
}
