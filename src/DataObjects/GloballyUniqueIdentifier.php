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

class GloballyUniqueIdentifier extends DataObject
{
    public function __construct(string $value, string $id = '00')
    {
        $this->assertMaxLength(2, $id);
        $this->assertMaxLength(32, $value);

        if ($id === '00') {
            parent::__construct(static::getStaticId(), strlen($value), $value);
        } else {
            parent::__construct($id, strlen($value), $value);
        }
    }

    /**
     * @return null|self
     */
    public static function tryParse(string $data)
    {
        $parts = parent::split($data);

        if ($parts[0] === static::getStaticId()) {
            return new static($parts[2]);
        }

        return null;
    }

    public static function getStaticId(): string
    {
        return '00';
    }
}
