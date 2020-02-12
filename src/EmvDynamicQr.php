<?php

/**
 * This file is part of the arcticfalcon/emv-qr-cps library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Juan Falcón <jcfalcon@gmail.com>
 * @license   http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Arcticfalcon\EmvQr;

use Arcticfalcon\EmvQr\DataObjects\CountryCode;
use Arcticfalcon\EmvQr\DataObjects\CRC;
use Arcticfalcon\EmvQr\DataObjects\GloballyUniqueIdentifier;
use Arcticfalcon\EmvQr\DataObjects\MerchantCategoryCode;
use Arcticfalcon\EmvQr\DataObjects\MerchantCity;
use Arcticfalcon\EmvQr\DataObjects\MerchantName;
use Arcticfalcon\EmvQr\DataObjects\PayloadFormatIndicator;
use Arcticfalcon\EmvQr\DataObjects\PointOfInitializationMethod;
use Arcticfalcon\EmvQr\DataObjects\PostalCode;
use Arcticfalcon\EmvQr\DataObjects\TipOrConvenienceIndicator;
use Arcticfalcon\EmvQr\DataObjects\TransactionAmount;
use Arcticfalcon\EmvQr\DataObjects\TransactionCurrency;
use Arcticfalcon\EmvQr\DataObjects\ValueOfConvenienceFeeFixed;
use Arcticfalcon\EmvQr\DataObjects\ValueOfConvenienceFeePercentage;
use Arcticfalcon\EmvQr\Templates\AdditionalDataField;
use Arcticfalcon\EmvQr\Templates\MerchantAccountInformation;

class EmvDynamicQr
{
    /**
     * @var PayloadFormatIndicator
     */
    private $payloadFormatIndicator;

    /**
     * @var PointOfInitializationMethod
     */
    private $pointOfInitializationMethod;

    /**
     * @var MerchantAccountInformation[]
     */
    private $merchantAccountInformationCollection;

    /**
     * @var MerchantCategoryCode
     */
    private $merchantCategoryCode;

    /**
     * @var TransactionCurrency
     */
    private $transactionCurrency;

    /**
     * @var TransactionAmount
     */
    private $transactionAmount;

    /**
     * @var TipOrConvenienceIndicator
     */
    private $tipOrConvenienceIndicator;

    /**
     * @var ValueOfConvenienceFeeFixed
     */
    private $valueOfConvenienceFeeFixed;

    /**
     * @var ValueOfConvenienceFeePercentage
     */
    private $valueOfConvenienceFeePercentage;

    /**
     * @var CountryCode
     */
    private $countryCode;

    /**
     * @var MerchantName
     */
    private $merchantName;

    /**
     * @var MerchantCity
     */
    private $merchantCity;

    /**
     * @var PostalCode
     */
    private $postalCode;

    /**
     * @var Template
     */
    private $additionalData;

    /**
     * @var string
     */
    private $merchantInformationLanguage;

    /**
     * @var string
     */
    private $unreservedTemplate;


    public function __construct()
    {
        $this->payloadFormatIndicator = new PayloadFormatIndicator();
        $this->pointOfInitializationMethod = new PointOfInitializationMethod(PointOfInitializationMethod::DYNAMIC);
    }

    /**
     * @param  MerchantAccountInformation $merchantAccountInformation
     * @return EmvDynamicQr
     */
    public function addMerchantAccountInformation(string $id, string $value): EmvDynamicQr
    {
        $this->merchantAccountInformationCollection[] = new MerchantAccountInformation(
            $id,
            new GloballyUniqueIdentifier($value)
        );
        return $this;
    }

    /**
     * @param  MerchantCategoryCode $merchantCategoryCode
     * @return EmvDynamicQr
     */
    public function setMerchantCategoryCode(string $merchantCategoryCode): EmvDynamicQr
    {
        $this->merchantCategoryCode = new MerchantCategoryCode($merchantCategoryCode);
        return $this;
    }

    /**
     * @param  TransactionCurrency $transactionCurrency
     * @return EmvDynamicQr
     */
    public function setTransactionCurrency(string $transactionCurrency): EmvDynamicQr
    {
        $this->transactionCurrency = new TransactionCurrency($transactionCurrency);
        return $this;
    }

    /**
     * @param  TransactionAmount $transactionAmount
     * @return EmvDynamicQr
     */
    public function setTransactionAmount(string $transactionAmount): EmvDynamicQr
    {
        $this->transactionAmount = new TransactionAmount($transactionAmount);
        return $this;
    }

    /**
     * @param  TipOrConvenienceIndicator $tipOrConvenienceIndicator
     * @return EmvDynamicQr
     */
    public function setTipOrConvenienceIndicator(string $tipOrConvenienceIndicator): EmvDynamicQr
    {
        $this->tipOrConvenienceIndicator = new TipOrConvenienceIndicator($tipOrConvenienceIndicator);
        return $this;
    }

    /**
     * @param  ValueOfConvenienceFeeFixed $valueOfConvenienceFeeFixed
     * @return EmvDynamicQr
     */
    public function setValueOfConvenienceFeeFixed(string $valueOfConvenienceFeeFixed): EmvDynamicQr
    {
        $this->valueOfConvenienceFeeFixed = new ValueOfConvenienceFeeFixed($valueOfConvenienceFeeFixed);
        return $this;
    }

    /**
     * @param  ValueOfConvenienceFeePercentage $valueOfConvenienceFeePercentage
     * @return EmvDynamicQr
     */
    public function setValueOfConvenienceFeePercentage(string $valueOfConvenienceFeePercentage): EmvDynamicQr
    {
        $this->valueOfConvenienceFeePercentage = new ValueOfConvenienceFeePercentage($valueOfConvenienceFeePercentage);
        return $this;
    }

    /**
     * @param  CountryCode $countryCode
     * @return EmvDynamicQr
     */
    public function setCountryCode(string $countryCode): EmvDynamicQr
    {
        $this->countryCode = new CountryCode($countryCode);
        return $this;
    }

    /**
     * @param  MerchantName $merchantName
     * @return EmvDynamicQr
     */
    public function setMerchantName(string $merchantName): EmvDynamicQr
    {
        $this->merchantName = new MerchantName($merchantName);
        return $this;
    }

    /**
     * @param  MerchantCity $merchantCity
     * @return EmvDynamicQr
     */
    public function setMerchantCity(string $merchantCity): EmvDynamicQr
    {
        $this->merchantCity = new MerchantCity($merchantCity);
        return $this;
    }

    /**
     * @param  PostalCode $postalCode
     * @return EmvDynamicQr
     */
    public function setPostalCode(string $postalCode): EmvDynamicQr
    {
        $this->postalCode = new PostalCode($postalCode);
        return $this;
    }

    /**
     * @param  Template $additionalData
     * @return EmvDynamicQr
     */
    public function setAdditionalData(string $additionalData): EmvDynamicQr
    {
        $this->additionalData = new AdditionalDataField($additionalData);
        return $this;
    }


    public function get(): void
    {
    }

    public function __toString()
    {
        $merchantAccountInformation = array_map(
            function (MerchantAccountInformation $information) {
                return (string) $information;
            },
            $this->merchantAccountInformationCollection
        );

        $data =
            (string) $this->payloadFormatIndicator .
            (string) $this->pointOfInitializationMethod .
            implode('', $merchantAccountInformation) .
            (string) $this->merchantCategoryCode .
            (string) $this->transactionCurrency .
            (string) $this->transactionAmount .
            (string) $this->tipOrConvenienceIndicator .
            (string) $this->valueOfConvenienceFeeFixed .
            (string) $this->valueOfConvenienceFeePercentage .
            (string) $this->countryCode .
            (string) $this->merchantName .
            (string) $this->merchantCity .
            (string) $this->postalCode .
            (string) $this->additionalData .
            (string) $this->merchantInformationLanguage .
            (string) $this->unreservedTemplate;

        $crc = new CRC($data);

        return $data . (string) $crc;
    }

    public static function dynamicMerchantPayload(
        string $merchantAccountInformationId,
        string $merchantAccountInformationValue,
        string $merchantCategoryCode,
        string $transactionCurrency,
        string $countryCode,
        string $merchantName,
        string $merchantCity,
        string $amount
    ): MerchantPayload {
        $merchantAccountInformation = new MerchantAccountInformation(
            $merchantAccountInformationId,
            new GloballyUniqueIdentifier($merchantAccountInformationValue)
        );

        $merchantPayload = new MerchantPayload(
            $merchantAccountInformation,
            new MerchantCategoryCode($merchantCategoryCode),
            new TransactionCurrency($transactionCurrency),
            new TransactionAmount($amount),
            null,
            null,
            null,
            new CountryCode($countryCode),
            new MerchantName($merchantName),
            new MerchantCity($merchantCity),
            null
        );
        $merchantPayload->addMerchantAccountInformation(
            new MerchantAccountInformation(
                '51',
                new GloballyUniqueIdentifier('0070365730004002672713')
            )
        );
        return $merchantPayload;
    }
}
