<?php
/*
 * Copyright(c) 2018 Daisy Inc. All Rights Reserved.
 *
 * This software is released under the MIT license.
 * http://opensource.org/licenses/mit-license.php
 */

namespace DaisyLink\Exchanger\Test;

use DaisyLink\Exchanger\AbstractExchanger;

class TestExchanger extends AbstractExchanger
{
    /**
     * @var string
     */
    private $rate;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return '';
    }

    /**
     * @param string $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * {@inheritdoc}
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * {@inheritdoc}
     */
    public function refreshRate()
    {
    }
}
