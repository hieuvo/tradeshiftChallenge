<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/15/17
 * Time: 1:55 PM
 */

namespace Tests\Unit\Utilities;

use Tradeshift\Interview\Utilities\Math;

class MathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider isFloatEqualProvider
     * @param $numbers
     * @param $expected
     */
    public function testIsFloatEqual($numbers, $expected)
    {
        $returnVal = Math::isFloatEqual(...$numbers);
        $this->assertEquals($returnVal, $expected);
    }

    public function isFloatEqualProvider()
    {
        return [
            [[1, 2, 3, 4], false],
            [[1, 1, 1.1, 1], false],
            [[1.0, 1.001, 1.0, 1.000001], false],
            [[-1.0, -1.001, -1.0, -1.000001], false],
            [[1], true],
            [[1.0, 1.0, 1.0], true],
            [[1.0, 1.00001, 1.0, 1.000001], true],
            [[-1.0, -1.00001, -1.0, -1.000001], true],
        ];
    }
}