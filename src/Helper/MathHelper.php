<?php

namespace IlicMiljan\WeightedRatings\Helper;

class MathHelper
{

    public static function percentPointFunction(float $x): float
    {
        return sqrt(2) * self::inverseErrorFunction(2 * $x-1);
    }

    public static function inverseErrorFunction(float $x): float
    {
        $a = ((8 * (M_PI - 3)) / ((3 * M_PI) * (4 - M_PI))); // 0.147
        $b = 2 / (M_PI * $a) + log(1 - $x**2) / 2;

        $signOfX = (($x < 0) ? -1.0 : 1.0 );

        $result = sqrt( $b**2 - log(1 - $x**2) / $a);
        $result = sqrt( $result - $b);

        return $result * $signOfX;
    }
}