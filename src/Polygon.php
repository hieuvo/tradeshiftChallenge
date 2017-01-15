<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/14/17
 * Time: 2:33 PM
 */

namespace Tradeshift\interview;

use Tradeshift\interview\Properties\PolygonPropertyInterface;

class Polygon implements PolygonInterface
{
    const INVALID_POLYGON_ERROR = "Invalid polygon";

    protected $_vertices = [];
    protected $_edgeLengths = [];

    /**
     * Polygon constructor.
     * @param Vertex[] ...$vertices
     * @throws \Exception
     */
    public function __construct(Vertex ...$vertices)
    {
        if (empty($vertices)) {
            throw new \InvalidArgumentException(static::INVALID_POLYGON_ERROR);
        }

        $this->_vertices = $vertices;
    }

    /**
     * @return PolygonPropertyInterface[]
     */
    public static function getProperties()
    {
        return [];
    }

    /**
     * @return PolygonPropertyInterface[]
     */
    public function getValidatedProperties()
    {
        $result = [];

        foreach (static::getProperties() as $property) {
            if ($property->validate($this)) {
                $result[] = $property;
            }
        }

        return $result;
    }

    /**
     * @param float[] $edgeLengths
     * @return Polygon|null
     */
    public static function tryToCreateFromEdgeLengths(array $edgeLengths)
    {
        return null;
    }

    /**
     * @param float[] $edgeLengths
     * @return bool
     */
    public static function validateEdgeLengths(array $edgeLengths)
    {
        return false;
    }

    /**
     * @return int
     */
    public function getNumberOfVertices()
    {
        return count($this->_vertices);
    }

    /**
     * @return float[]
     */
    public function getEdgeLengths()
    {
        if (empty($this->_edgeLengths)) {
            $this->calculateEdgeLengths();
        }

        return $this->_edgeLengths;
    }

    /**
     * try to figure out edge lengths from vertices
     */
    public function calculateEdgeLengths()
    {
        /** @var Vertex|null $previousVertex */
        $previousVertex = null;
        $tmpVertices = $this->_vertices;
        $tmpVertices[] = $this->_vertices[0];

        foreach ($tmpVertices as $vertex) {
            if ($previousVertex) {
                $this->_edgeLengths[] = $previousVertex->distanceTo($vertex);
            }

            $previousVertex = $vertex;
        }
    }
}