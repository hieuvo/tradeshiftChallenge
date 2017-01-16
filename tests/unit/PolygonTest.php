<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/15/17
 * Time: 1:53 PM
 */

namespace Tests\Unit;

use Tradeshift\Interview\Polygon;
use Tradeshift\Interview\Properties\Triangle\Equilateral;
use Tradeshift\Interview\Properties\Triangle\Isosceles;
use Tradeshift\Interview\Properties\Triangle\Scalene;
use Tradeshift\Interview\Triangle;
use Tradeshift\Interview\Vertex;

class PolygonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionWhenCreateNewPolygon()
    {
        new Polygon(...[]);
    }

    public function testValidateEdgeLengths()
    {
        $returnVal = Polygon::validateEdgeLengths([]);
        $this->assertFalse($returnVal);
    }

    /**
     * @param Vertex[] $vertices
     * @dataProvider successfullyCreatenewPolygonProvider
     */
    public function testSuccessfullyCreatenewPolygon($vertices)
    {
        new Polygon(...$vertices);
    }

    public function successfullyCreatenewPolygonProvider()
    {
        return [
            [[new Vertex(0, 0)]],
            [[new Vertex(-123, 1.123)]],
            [[new Vertex(0, 0), new Vertex(0, 0), new Vertex(0, 0)]],
            [[new Vertex(1, 1), new Vertex(2, 3), new Vertex(4, 5)]],
            [[new Vertex(-1, -1), new Vertex(-2, -3), new Vertex(-4, -5)]],
            [[new Vertex('-1', -1), new Vertex('1.123', -3), new Vertex(-4, '-4.123')]],
        ];
    }

    public function testGetProperties()
    {
        $properties = Polygon::getProperties();
        $this->assertEmpty($properties);
    }

    public function testValidatedGetProperties()
    {
        $properties = Polygon::getProperties();
        $this->assertEmpty($properties);
    }

    public function testTryToCreateFromEdgeLengths()
    {
        $returnVal = Polygon::tryToCreateFromEdgeLengths([]);
        $this->assertNull($returnVal);
    }

    /**
     * @dataProvider getNumberOfVerticesProvider
     * @param Polygon $polygon
     * @param $expected
     */
    public function testGetNumberOfVertices($polygon, $expected)
    {
        $this->assertEquals($polygon->getNumberOfVertices(), $expected);
    }

    public function getNumberOfVerticesProvider()
    {
        return [
            [new Polygon(new Vertex(0, 0)), 1],
            [new Polygon(new Vertex(0, 0), new Vertex(1, 1)), 2],
            [new Polygon(new Vertex(0, 0), new Vertex(-1, -1), new Vertex(2, -2)), 3],
        ];
    }
}