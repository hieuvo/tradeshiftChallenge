<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/16/17
 * Time: 2:29 AM
 */

namespace Tradeshift\interview\Utilities;

class Math
{
    const MINIMUM_DOUBLE_PRECISION = 0.0001;

    /**
     * @param float[] ...$numbers
     * @return bool
     */
    public static function isFloatEqual(float ...$numbers)
    {
        $numbers[] = $numbers[0];
        $result = true;
        $previousNumber = null;

        foreach ($numbers as $number) {
            if ($previousNumber) {
                $result = $result && abs($previousNumber - $number) < static::MINIMUM_DOUBLE_PRECISION;
            }

            $previousNumber = $number;
        }

        return $result;
    }
}