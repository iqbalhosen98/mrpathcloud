<?php

namespace Mrpath\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Mrpath\Category\Database\Seeders\DatabaseSeeder as CategorySeeder;
use Mrpath\Attribute\Database\Seeders\DatabaseSeeder as AttributeSeeder;
use Mrpath\Core\Database\Seeders\DatabaseSeeder as CoreSeeder;
use Mrpath\User\Database\Seeders\DatabaseSeeder as UserSeeder;
use Mrpath\Customer\Database\Seeders\DatabaseSeeder as CustomerSeeder;
use Mrpath\Inventory\Database\Seeders\DatabaseSeeder as InventorySeeder;
use Mrpath\CMS\Database\Seeders\DatabaseSeeder as CMSSeeder;
use Mrpath\SocialLogin\Database\Seeders\DatabaseSeeder as SocialLoginSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(CoreSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CMSSeeder::class);
        $this->call(SocialLoginSeeder::class);
    }
}
