<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/14/17
 * Time: 3:01 PM
 */

namespace Tradeshift\interview;

use Tradeshift\interview\Properties\PolygonPropertyInterface;

interface PolygonInterface
{
    /**
     * @return PolygonPropertyInterface[]
     */
    public static function getProperties();

    /**
     * @return PolygonPropertyInterface[]
     */
    public function getValidatedProperties();

    /**
     * @param float[] $edgeLengths
     * @return Polygon|null
     */
    public static function tryToCreateFromEdgeLengths(array $edgeLengths);

    /**
     * @param float[] $edgeLengths
     * @return bool
     */
    public static function validateEdgeLengths(array $edgeLengths);

    /**
     * @return int
     */
    public function getNumberOfVertices();

    /**
     * @return float[]
     */
    public function getEdgeLengths();

    public function calculateEdgeLengths();
}