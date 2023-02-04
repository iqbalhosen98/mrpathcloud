<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Mrpath\Velocity\Database\Seeders\VelocityMetaDataSeeder;
use Mrpath\Admin\Database\Seeders\DatabaseSeeder as BagistoDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BagistoDatabaseSeeder::class);
        $this->call(VelocityMetaDataSeeder::class);
    }
}
