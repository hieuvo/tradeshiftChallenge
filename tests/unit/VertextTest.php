<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/15/17
 * Time: 1:54 PM
 */

namespace Tests\Unit;

use Tradeshift\interview\Vertex;

class VertextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider exceptionWhenCreateNewVertexProvider
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionWhenCreateNewVertex($x, $y)
    {
        new Vertex($x, $y);
    }

    public function exceptionWhenCreateNewVertexProvider()
    {
        return [
            ['a', 0],
            [0, 'a'],
            ['a', 'b'],
            [1, new \stdClass()]
        ];
    }

    /**
     * @dataProvider validateProvider
     */
    public function testValidate($x, $y, $z, $expected)
    {
        $v = new Vertex(1, 2);

        $returnVal = PHPUnitUtil::callMethod($v, 'validate', [$x, $y, $z]);

        $this->assertEquals($returnVal, $expected);
    }

    public function validateProvider()
    {
        return [
            ['a', 0, 0, false],
            [0, 'a', 1, false],
            ['a', 'b', 'c', false],
            [1, new \stdClass(), 1, false],
            [0, 0, 0, true],
            [123, 4312, 2222, true],
            ['1', '1.234', '22222', true],
            [333, '1.234', 1111, true],
        ];
    }

    /**
     * @dataProvider successfullyCreateNewVertexProvider
     * @param $x
     * @param $y
     */
    public function testSuccessfullyCreateNewVertex($x, $y)
    {
        $v = new Vertex($x, $y);

        $this->assertEquals($v->getX(), $x);
        $this->assertEquals($v->getY(), $y);
        $this->assertEquals($v->getZ(), 0);
    }

    public function successfullyCreateNewVertexProvider()
    {
        return [
            [0, 0],
            [123, 4312],
            ['1', '1.234'],
            [333, '1.234'],
        ];
    }

    public function testGetterSetter()
    {
        $v = new Vertex(1.123, 123);

        $this->assertEquals($v->getX(), 1.123);
        $this->assertEquals($v->getY(), 123);
        $this->assertEquals($v->getZ(), 0);

        $v->setX(1.111);
        $v->setY(2.222);
        $v->setZ(3.333);

        $this->assertEquals($v->getX(), 1.111);
        $this->assertEquals($v->getY(), 2.222);
        $this->assertEquals($v->getZ(), 3.333);

        $v->setX('1.111');
        $v->setY('2.222');
        $v->setZ('3.333');

        $this->assertEquals($v->getX(), 1.111);
        $this->assertEquals($v->getY(), 2.222);
        $this->assertEquals($v->getZ(), 3.333);
    }

    /**
     * @dataProvider distanceToProvider
     */
    public function testDistanceTo($v1, $v2, $expected)
    {
        /** @var Vertex $v1 */
        $returnValue = $v1->distanceTo($v2);
        $this->assertEquals($returnValue, $expected);
    }

    public function distanceToProvider()
    {
        return [
            [new Vertex(0, 0), new Vertex(0, 0), 0],
            [new Vertex(10, 10, 10), new Vertex(10, 10, 10), 0],
            [new Vertex(0, 0), new Vertex(1, 1), sqrt(2)],
            [new Vertex(0, 0, 0), new Vertex(1, 1, 1), sqrt(3)],
            [new Vertex(0, 0, 0), new Vertex(0, 3, 0), 3],
            [new Vertex(0, 0, 0), new Vertex(5, 0, 0), 5],
            [new Vertex(0, 0, 0), new Vertex(0, 0, 7), 7],
            [new Vertex(0, 0, 0), new Vertex(0, -3, 0), 3],
            [new Vertex(0, 0, 0), new Vertex(-5, 0, 0), 5],
            [new Vertex(0, 0, 0), new Vertex(0, 0, -7), 7],
            [new Vertex(0, 0, 0), new Vertex(3, -4, 0), 5],
        ];
    }
}