<?php
/*
 * Copyright(c) 2018 Daisy Inc. All Rights Reserved.
 *
 * This software is released under the MIT license.
 * http://opensource.org/licenses/mit-license.php
 */

namespace DaisyLink\Exchanger;

use DaisyLink\Exchanger\Exception\ExchangeException;
use DaisyLink\Exchanger\Exception\GetRateException;

interface ExchangerInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $from
     * @param integer $divisibility
     * @return string
     * @throws GetRateException
     * @throws ExchangeException
     */
    public function exchange($from, $divisibility);

    /**
     * @param string $from
     * @param integer $divisibility
     * @return string
     * @throws GetRateException
     * @throws ExchangeException
     */
    public function reverseExchange($from, $divisibility);

    /**
     * @return string
     * @throws GetRateException
     */
    public function getRate();

    /**
     * @return void
     * @throws GetRateException
     */
    public function refreshRate();
}
