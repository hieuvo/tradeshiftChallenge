<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/15/17
 * Time: 11:41 AM
 */

namespace Tradeshift\Interview\Properties;

use Tradeshift\Interview\PolygonInterface;

interface PolygonPropertyInterface
{
    /**
     * @return string
     */
    public static function getName();

    /**
     * @param PolygonInterface $polygon
     * @return bool
     */
    public function validate(PolygonInterface $polygon);
}