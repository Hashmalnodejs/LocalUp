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
        // $this->call(UsersTableSeeder::class);
        $this->call(ModuleTypesTableSeeder::class);
        $this->call(LocalTypesTableSeeder::class);
        $this->call(LocalsTableSeeder::class);
        $this->call(FlatRatesTableSeeder::class);
        $this->call(DurationTypesTableSeeder::class);
        $this->call(DurationsTableSeeder::class);
    }
}
