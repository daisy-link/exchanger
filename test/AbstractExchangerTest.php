<?php
/*
 * Copyright(c) 2018 Daisy Inc. All Rights Reserved.
 *
 * This software is released under the MIT license.
 * http://opensource.org/licenses/mit-license.php
 */

namespace DaisyLink\Exchanger\Test;

use DaisyLink\Exchanger\Exception\DivideByZeroException;
use PHPUnit\Framework\TestCase;

class AbstractExchangerTest extends TestCase
{
    /**
     * @var TestExchanger
     */
    protected $exchanger;

    public function setUp()
    {
        parent::setUp();

        $this->exchanger = new TestExchanger();
    }

    /**
     * @return array
     */
    public function provideDivideByZeroValues()
    {
        return array(
            array('0'),
            array(0),
            array('000'),
            array('0.000'),
            array('0.0000001'),
            array(null),
            array(false),
            array('a'),
            array('3a'),
        );
    }

    /**
     * @dataProvider provideDivideByZeroValues
     * @param $rate
     */
    public function testExchange_divideByZero($rate)
    {
        $this->exchanger->setRate($rate);

        try {
            $this->exchanger->exchange('1000', 6);
            $this->fail();
        } catch (DivideByZeroException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @return array
     */
    public function provideExchangeValues()
    {
        return array(
            array('50.0', 3, '2.000'),
            array('6.0', 6, '16.666666'),
        );
    }

    /**
     * @dataProvider provideExchangeValues
     * @param $rate
     * @param $divisibility
     * @param $expected
     */
    public function testExchange($rate, $divisibility, $expected)
    {
        $this->exchanger->setRate($rate);
        $this->assertSame($expected, $this->exchanger->exchange('100', $divisibility));
    }

    /**
     * @return array
     */
    public function provideReverseExchangeValues()
    {
        return array(
            array('3.0', 3, '300.0'),
            array('3.0000', 3, '300.000'),
            array('0.0000001', 6, '0.000010'),
            array('0.000000001', 6, '0.000000'),
        );
    }

    /**
     * @dataProvider provideReverseExchangeValues
     * @param $rate
     * @param $divisibility
     * @param $expected
     */
    public function testReverseExchange($rate, $divisibility, $expected)
    {
        $this->exchanger->setRate($rate);
        $this->assertSame($expected, $this->exchanger->reverseExchange('100', $divisibility));
    }
}
