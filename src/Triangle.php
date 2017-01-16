<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/14/17
 * Time: 2:33 PM
 */

namespace Tradeshift\Interview;

use Tradeshift\Interview\Properties\PolygonPropertyInterface;
use Tradeshift\Interview\Properties\Triangle\Equilateral;
use Tradeshift\Interview\Properties\Triangle\Isosceles;
use Tradeshift\Interview\Properties\Triangle\Scalene;

class Triangle extends Polygon
{
    const NUMBER_OF_VERTICES = 3;
    const INVALID_TRIANGLE_ERROR = "Invalid triangle";

    /**
     * Triangle constructor.
     * @param Vertex[] ...$vertices
     * @throws \Exception
     */
    public function __construct(Vertex ...$vertices)
    {
        if (count($vertices) != static::NUMBER_OF_VERTICES) {
            throw new \InvalidArgumentException(static::INVALID_TRIANGLE_ERROR);
        }

        parent::__construct(...$vertices);
    }

    /**
     * @param float[] $edgeLengths
     * @return Triangle|null
     */
    public static function tryToCreateFromEdgeLengths(array $edgeLengths)
    {
        if (!static::validateEdgeLengths($edgeLengths)) {
            return null;
        }

        $tmpX = $edgeLengths[0]/2 + (pow($edgeLengths[1], 2) - pow($edgeLengths[2], 2)) / (2 * $edgeLengths[0]);
        $tmpY = sqrt(pow($edgeLengths[2], 2) - pow($tmpX, 2));

        $vertex1 = new Vertex(0, 0);
        $vertex2 = new Vertex($edgeLengths[0], 0);
        $vertex3 = new Vertex($tmpX, $tmpY);
        $triangle = new Triangle($vertex1, $vertex2, $vertex3);
        $triangle->_edgeLengths = $edgeLengths;

        return $triangle;
    }

    /**
     * @param float[] $edgeLengths
     * @return bool
     */
    public static function validateEdgeLengths(array $edgeLengths)
    {
        return count($edgeLengths) == 3
            && is_numeric($edgeLengths[0] ?? null)
            && is_numeric($edgeLengths[1] ?? null)
            && is_numeric($edgeLengths[2] ?? null)
            && $edgeLengths[0] + $edgeLengths[1] > $edgeLengths[2]
            && $edgeLengths[0] + $edgeLengths[2] > $edgeLengths[1]
            && $edgeLengths[1] + $edgeLengths[2] > $edgeLengths[0];
    }

    /**
     * @return PolygonPropertyInterface[]
     */
    public static function getProperties()
    {
        return [
            new Scalene(),
            new Isosceles(),
            new Equilateral()
        ];
    }
}