<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/15/17
 * Time: 1:55 PM
 */

namespace Tests\Unit\Properties\Triangle;

use Tradeshift\interview\Properties\Triangle\Isosceles;
use Tradeshift\interview\Triangle;
use Tradeshift\interview\Vertex;
use Tradeshift\interview\Polygon;

class IsoscelesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validateProvider
     * @param $polygon
     * @param $expected
     */
    public function testValidate($polygon, $expected)
    {
        $validator = new Isosceles();
        $returnVal = $validator->validate($polygon);
        $this->assertEquals($returnVal, $expected);
    }

    public function validateProvider()
    {
        return [
            [new Polygon(new Vertex(0, 0)), false],
            [new Triangle(new Vertex(0, 0), new Vertex(1, 2), new Vertex(1, 1)), false],
            [new Triangle(new Vertex(0, 0), new Vertex(0, 2), new Vertex(2, 0)), true],
            [new Triangle(new Vertex(0, 0), new Vertex(0, -2), new Vertex(-2, 0)), true],
            [new Triangle(new Vertex(0, 0), new Vertex(4, 0), new Vertex(2, sqrt(12))), false],
            [new Triangle(new Vertex(0, 0), new Vertex(-4, 0), new Vertex(-2, sqrt(12))), false],
            [new Triangle(new Vertex(0, 0), new Vertex(-4, 0), new Vertex(-2, -sqrt(12))), false],
        ];
    }
}