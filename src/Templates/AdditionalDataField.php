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

namespace Arcticfalcon\EmvQr\Templates;

use Arcticfalcon\EmvQr\DataObjects\GloballyUniqueIdentifier;
use Arcticfalcon\EmvQr\DataObjects\PaymentNetworkSpecific;
use Arcticfalcon\EmvQr\EmvQrHelper;
use Arcticfalcon\EmvQr\Template;

class AdditionalDataField extends Template
{
    public function __construct($value)
    {
        $identifier = new GloballyUniqueIdentifier($value);

        $this->dataObjects = [
            $identifier,
        ];

        parent::__construct('62', 1, '');
        // Length and value are dynamically evaluated in Template

        $this->assertValueLength();
    }

    public function addTemplateDataObject(PaymentNetworkSpecific $object): void
    {
        $this->dataObjects[] = $object;

        $this->assertValueLength();
    }

    /**
     * @return null|self
     */
    public static function tryParse(string $data)
    {
        try {
            $parts = parent::split($data);

            // Parse content
            $subParts = EmvQrHelper::splitCode($parts[2]);

            $gui = GloballyUniqueIdentifier::tryParse($subParts[GloballyUniqueIdentifier::getStaticId()]);
            unset($subParts[GloballyUniqueIdentifier::getStaticId()]);

            // Create instance
            return new static($gui);
        } catch (\Exception $exception) {
            return null;
        }
    }

    public static function getStaticId(): string
    {
        throw new \LogicException();
    }

    public static function matchesId(string $id): bool
    {
        return in_array($id, range(62, 62));
    }

    private function assertValueLength(): void
    {
        $value = '';
        foreach ($this->dataObjects as $object) {
            $value .= (string)$object;
        }

        $this->assertMaxLength(99, $value);
    }
}
