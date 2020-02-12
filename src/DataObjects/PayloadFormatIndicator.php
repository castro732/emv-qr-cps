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

namespace Arcticfalcon\EmvQr\DataObjects;

use Arcticfalcon\EmvQr\DataObject;

class PayloadFormatIndicator extends DataObject
{
    public function __construct()
    {
        parent::__construct(static::getStaticId(), 2, '01');
    }

    /**
     * @return null|self
     */
    public static function tryParse(string $data)
    {
        $parts = parent::split($data);

        if ($parts[0] === static::getStaticId()) {
            return new static();
        }

        return null;
    }

    public static function getStaticId(): string
    {
        return '00';
    }
}
