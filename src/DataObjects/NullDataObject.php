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

class NullDataObject extends DataObject
{
    public function __construct()
    {
        parent::__construct('00', 2, '');
    }

    public function __toString()
    {
        return '';
    }

    /**
     * @return void
     */
    public static function tryParse(string $data)
    {
        throw new \LogicException();
    }

    public static function getStaticId(): string
    {
        throw new \LogicException();
    }
}
