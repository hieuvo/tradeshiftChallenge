<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/15/17
 * Time: 1:53 PM
 */

namespace Tests\Unit;

use Tradeshift\interview\Properties\Triangle\Equilateral;
use Tradeshift\interview\Properties\Triangle\Isosceles;
use Tradeshift\interview\Properties\Triangle\Scalene;
use Tradeshift\interview\Triangle;
use Tradeshift\interview\Vertex;

class TriangleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider exceptionWhenCreateNewTriangleProvider
     * @expectedException \InvalidArgumentException
     * @param Vertex[]  $vertices
     */
    public function testExceptionWhenCreateNewTriangle($vertices)
    {
        new Triangle(...$vertices);
    }

    public function exceptionWhenCreateNewTriangleProvider()
    {
        return [
            [[new Vertex(0, 0)]],
            [[new Vertex(0, 0), new Vertex(0, 0)]],
            [[new Vertex(0, 0), new Vertex(0, 0), new Vertex(0, 0), new Vertex(0, 0)]],
        ];
    }

    /**
     * @dataProvider validateEdgeLengthsProvider
     * @param float[] $edgeLengths
     * @param bool $expected
     */
    public function testValidateEdgeLengths($edgeLengths, $expected)
    {
        $returnVal = Triangle::validateEdgeLengths($edgeLengths);
        $this->assertTrue($returnVal == $expected);
    }

    public function validateEdgeLengthsProvider()
    {
        return [
            [[0], false],
            [[0, 0], false],
            [[0, 0, 0], false],
            [['a' => 0, 1 => 0, '123' => 0], false],
            [[1, 1, 2], false],
            [[1, 3, 4], false],
            [['a', 3, 4], false],
            [[1, 'c', 4], false],
            [[1, 'c', 'd'], false],
            [[-3, 4, 5], false],
            [[3, 4, 5], true],
            [[2, 2, 3], true],
            [[3, 5.123, 4.321], true],
            [['3', '5.123', '4.321'], true],
        ];
    }

    /**
     * @param Vertex[] $vertices
     * @dataProvider successfullyCreateNewTriangleProvider
     */
    public function testSuccessfullyCreateNewTriangle($vertices)
    {
        $triangle = new Triangle(...$vertices);
        $this->assertEquals($triangle->getNumberOfVertices(), 3);
    }

    public function successfullyCreateNewTriangleProvider()
    {
        return [
            [[new Vertex(0, 0), new Vertex(0, 0), new Vertex(0, 0)]],
            [[new Vertex(1, 1), new Vertex(2, 3), new Vertex(4, 5)]],
            [[new Vertex(-1, -1), new Vertex(-2, -3), new Vertex(-4, -5)]],
            [[new Vertex('-1', -1), new Vertex('1.123', -3), new Vertex(-4, '-4.123')]],
        ];
    }

    public function testGetProperties()
    {
        $properties = Triangle::getProperties();
        $propertyNames = [];
        foreach ($properties as $property) {
            $propertyNames[] = $property->getName();
        }

        $allPropertyNames = [Scalene::getName(), Equilateral::getName(), Isosceles::getName()];
        sort($propertyNames);
        sort($allPropertyNames);

        $this->assertEquals($propertyNames, $allPropertyNames);
    }

    /**
     * @param Vertex[] $vertices
     * @param string[] $expectedProperties
     * @dataProvider validatedGetPropertiesProvider
     */
    public function testValidatedGetProperties($vertices, $expectedProperties)
    {
        $triangle = new Triangle(...$vertices);
        $validatedProperties = $triangle->getValidatedProperties();
        $validatedPropertyNames = [];

        foreach ($validatedProperties as $validatedProperty) {
            $validatedPropertyNames[] = $validatedProperty->getName();
        }

        sort($validatedPropertyNames);
        sort($expectedProperties);

        $this->assertEquals($validatedPropertyNames, $expectedProperties);
    }

    public function validatedGetPropertiesProvider()
    {
        return [
            [[new Vertex(0, 0), new Vertex(2, 0), new Vertex(0, 2)], [Isosceles::getName()]],
            [[new Vertex(0, 0), new Vertex(3, 0), new Vertex(0, 4)], [Scalene::getName()]],
            [[new Vertex(0, 0), new Vertex(4, 0), new Vertex(2, sqrt(12))], [Equilateral::getName()]],
        ];
    }

    /**
     * @dataProvider tryToCreateFromEdgeLengthsProvider
     * @param $edgeLengths
     * @param $expected
     */
    public function testTryToCreateFromEdgeLengths($edgeLengths, $expected)
    {
        $returnVal = Triangle::tryToCreateFromEdgeLengths($edgeLengths);
        if ($expected) {
            $this->assertInstanceOf(Triangle::class, $returnVal);
            $this->assertEquals($returnVal->getEdgeLengths(), $edgeLengths);
            $this->assertEquals($returnVal->getNumberOfVertices(), 3);
        } else {
            $this->assertNull($returnVal);
        }
    }

    public function tryToCreateFromEdgeLengthsProvider()
    {
        return [
            [[0, 1, 2], false],
            [[0, -1, 2], false],
            [[1, 1, 1], true],
            [[3, 4, 5], true],
            [[1, 2, 2], true],
            [[1, 2, 2.5], true],
        ];
    }
}