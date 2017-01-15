<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/14/17
 * Time: 3:03 PM
 */

namespace Tradeshift\interview;

class Vertex
{
    const INVALID_VERTEX_ERROR = "Invalid vertex";

    protected $_x;
    protected $_y;
    protected $_z;

    /**
     * Vertex constructor.
     * @param float $x
     * @param float $y
     * @param float $z
     */
    public function __construct($x, $y, $z = 0.0)
    {
        if (!$this->validate($x, $y, $z)) {
            throw new \InvalidArgumentException(static::INVALID_VERTEX_ERROR);
        }

        $this->_x = floatval($x);
        $this->_y = floatval($y);
        $this->_z = floatval($z);
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->_x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->_y;
    }

    /**
     * @return float
     */
    public function getZ(): float
    {
        return $this->_z;
    }

    /**
     * @param float $x
     */
    public function setX(float $x)
    {
        $this->_x = $x;
    }

    /**
     * @param float $y
     */
    public function setY(float $y)
    {
        $this->_y = $y;
    }

    /**
     * @param float $z
     */
    public function setZ(float $z)
    {
        $this->_z = $z;
    }

    /**
     * @param $x
     * @param $y
     * @param $z
     * @return bool
     */
    protected function validate($x, $y, $z)
    {
        return is_numeric($x)
            && is_numeric($y)
            && is_numeric($z);
    }

    /**
     * @param Vertex $v
     * @return float
     */
    public function distanceTo(Vertex $v)
    {
        return sqrt(
            pow($this->_x - $v->_x, 2) + pow(($this->_y - $v->_y), 2) + pow(($this->_z - $v->_z), 2)
        );
    }
}