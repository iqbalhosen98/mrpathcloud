<?php

namespace Tests\Unit\Product\Helpers;

use UnitTester;
use Mrpath\Product\Helpers\ProductType;

class ProductTypeCest
{
    public function testHasVariants(UnitTester $I)
    {
        $I->assertTrue(ProductType::hasVariants('configurable'));
        $I->assertFalse(ProductType::hasVariants('simple'));
    }
}
