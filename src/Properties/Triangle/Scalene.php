<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/14/17
 * Time: 2:58 PM
 */

namespace Tradeshift\Interview\Properties\Triangle;

use Tradeshift\Interview\Properties\PolygonPropertyInterface;
use Tradeshift\Interview\PolygonInterface;
use Tradeshift\Interview\Triangle;
use Tradeshift\Interview\Utilities\Math;

class Scalene implements PolygonPropertyInterface
{
    /**
     * @return string
     */
    public static function getName()
    {
        return 'Scalene';
    }

    /**
     * @param PolygonInterface $polygon
     * @return bool
     */
    public function validate(PolygonInterface $polygon)
    {
        if (!($polygon instanceof Triangle)) {
            return false;
        }

        $edgeLengths = $polygon->getEdgeLengths();

        return !Math::isFloatEqual($edgeLengths[0], $edgeLengths[1])
            && !Math::isFloatEqual($edgeLengths[0], $edgeLengths[2])
            && !Math::isFloatEqual($edgeLengths[1], $edgeLengths[2]);
    }
}