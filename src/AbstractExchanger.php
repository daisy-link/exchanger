<?php
/*
 * Copyright(c) 2018 Daisy Inc. All Rights Reserved.
 *
 * This software is released under the MIT license.
 * http://opensource.org/licenses/mit-license.php
 */

namespace DaisyLink\Exchanger;

use DaisyLink\Exchanger\Exception\DivideByZeroException;

abstract class AbstractExchanger implements ExchangerInterface
{
    /**
     * {@inheritdoc}
     * @throws DivideByZeroException
     */
    public function exchange($from, $divisibility)
    {
        $rate = $this->getRate();

        if (bccomp($rate, '0', $divisibility) === 0) {
            throw new DivideByZeroException('Divide by zero.');
        }

        return bcdiv($from, $rate, $divisibility);
    }

    /**
     * {@inheritdoc}
     */
    public function reverseExchange($from, $divisibility)
    {
        return bcmul($from, $this->getRate(), $divisibility);
    }
}
