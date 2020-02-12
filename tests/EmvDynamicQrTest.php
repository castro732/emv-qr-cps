<?php

declare(strict_types=1);

namespace Arcticfalcon\EmvQr\Test;

use Arcticfalcon\EmvQr\EmvDynamicQr;
use Arcticfalcon\EmvQr\Iso3166Countries;
use Arcticfalcon\EmvQr\Iso4217Currency;

class EmvDynamicQrTest extends TestCase
{
    public function test_that_a_dynamic_qr_is_generated_correctly()
    {
        $original = '00020101021250150011203487045355126002200703657300040026727135204481653030325406105.505802AR5913Vinoteca S.A.6008Balcarce622005168hqyFJ6eD7vTWXL5630465C7';

        $qr = new EmvDynamicQr();

        $qr->addMerchantAccountInformation('50', '20348704535')
            ->addMerchantAccountInformation('51', '0070365730004002672713')
            ->setMerchantCategoryCode('4816')
            ->setTransactionCurrency(Iso4217Currency::ARS)
            ->setTransactionAmount('105.50')
            ->setCountryCode(Iso3166Countries::ARGENTINA)
            ->setMerchantName('Vinoteca S.A.')
            ->setMerchantCity('Balcarce')
            ->setAdditionalData('8hqyFJ6eD7vTWXL5');

        static::assertEquals($original, (string)$qr);
    }
}
