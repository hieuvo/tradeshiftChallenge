<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/14/17
 * Time: 2:58 PM
 */

namespace Tradeshift\interview\Properties\Triangle;

use Tradeshift\interview\Properties\PolygonPropertyInterface;
use Tradeshift\interview\PolygonInterface;
use Tradeshift\interview\Triangle;
use Tradeshift\interview\Utilities\Math;

class Isosceles implements PolygonPropertyInterface
{
    /**
     * @return string
     */
    public static function getName()
    {
        return 'Isosceles';
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

        return (Math::isFloatEqual($edgeLengths[0], $edgeLengths[1]) && !Math::isFloatEqual($edgeLengths[0], $edgeLengths[2]))
            || (Math::isFloatEqual($edgeLengths[0], $edgeLengths[2]) && !Math::isFloatEqual($edgeLengths[0], $edgeLengths[1]))
            || (Math::isFloatEqual($edgeLengths[1], $edgeLengths[2]) && !Math::isFloatEqual($edgeLengths[0], $edgeLengths[1]));
    }
}