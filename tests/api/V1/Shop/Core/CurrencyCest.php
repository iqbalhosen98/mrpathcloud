<?php

namespace Tests\API\V1\Shop\Core;

use ApiTester;
use Mrpath\Core\Models\Currency;

class CurrencyCest extends CoreCest
{
    public function testForFetchingAllTheCurrencies(ApiTester $I)
    {
        $I->sendGet($this->getVersionRoute('currencies'));

        $I->seeAllNecessarySuccessResponse();
    }

    public function testForFetchingTheCurrencyById(ApiTester $I)
    {
        $currency = Currency::find(1);

        $I->sendGet($this->getVersionRoute('currencies/' . $currency->id));

        $I->seeAllNecessarySuccessResponse();

        $I->seeResponseContainsJson([
            'id'   => $currency->id,
            'code' => $currency->code,
            'name' => $currency->name,
        ]);
    }
}
