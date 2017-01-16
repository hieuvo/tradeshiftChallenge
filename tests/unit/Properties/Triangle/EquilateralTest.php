<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/15/17
 * Time: 1:54 PM
 */

namespace Tests\Unit\Properties\Triangle;

use Tradeshift\Interview\Polygon;
use Tradeshift\Interview\Properties\Triangle\Equilateral;
use Tradeshift\Interview\Triangle;
use Tradeshift\Interview\Vertex;

class EquilateralTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validateProvider
     * @param $polygon
     * @param $expected
     */
    public function testValidate($polygon, $expected)
    {
        $validator = new Equilateral();
        $returnVal = $validator->validate($polygon);
        $this->assertEquals($returnVal, $expected);
    }

    public function validateProvider()
    {
        return [
            [new Polygon(new Vertex(0, 0)), false],
            [new Triangle(new Vertex(0, 0), new Vertex(1, 2), new Vertex(1, 1)), false],
            [new Triangle(new Vertex(0, 0), new Vertex(0, 2), new Vertex(2, 0)), false],
            [new Triangle(new Vertex(0, 0), new Vertex(0, -2), new Vertex(-2, 0)), false],
            [new Triangle(new Vertex(0, 0), new Vertex(4, 0), new Vertex(2, sqrt(12))), true],
            [new Triangle(new Vertex(0, 0), new Vertex(-4, 0), new Vertex(-2, sqrt(12))), true],
            [new Triangle(new Vertex(0, 0), new Vertex(-4, 0), new Vertex(-2, -sqrt(12))), true],
        ];
    }
}