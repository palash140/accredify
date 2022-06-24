<?php

namespace Database\Seeders;

use Database\Seeders\NationalityCodeSeeder;
use Database\Seeders\RegisterLabSeeder;
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

         $this->call([
            RegisterLabSeeder::class,
            NationalityCodeSeeder::class,
            DummyNationalityCodeMappingSeeder::class
        ]);
    }
}
