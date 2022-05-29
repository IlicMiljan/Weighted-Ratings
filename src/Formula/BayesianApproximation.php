<?php

namespace IlicMiljan\WeightedRatings\Formula;

class BayesianApproximation extends AbstractFormula
{

    public function calculateWeight(): float
    {
        // TODO: Add sum() to Collection
        if (array_sum($this->ratings->all()) === 0) {
            return 0.0;
        }

        $K = $this->ratings->count();
        $z = $this->calculateZ($this->ratingWeightConfig->getConfidence());
        $N = array_sum($this->ratings->all());

        $firstPart = 0.0;
        $secondPart = 0.0;

        foreach($this->ratings->all() as $index => $value) {
            $firstPart += ($index + 1) * ($value + 1) / ($N + $K);
            $secondPart += ($index + 1) * ($index + 1) * ($value + 1) / ($N + $K);
        }

        return $firstPart - $z * sqrt(($secondPart - $firstPart**2) / ($N + $K + 1));
    }

    // TODO: Create MathHelper
    private function calculateZ(float $confidence): float
    {
        return $this->percentPointFunction(1 - (1 - $confidence) / 2);
    }

    private function percentPointFunction(float $x): float
    {
        return sqrt(2) * $this->inverseErrorFunction(2 * $x-1);
    }

    private function inverseErrorFunction(float $x): float
    {
        $a = ((8 * (M_PI - 3)) / ((3 * M_PI) * (4 - M_PI))); // 0.147
        $b = 2 / (M_PI * $a) + log(1 - $x**2) / 2;

        $signOfX = (($x < 0) ? -1.0 : 1.0 );

        $result = sqrt( $b**2 - log(1 - $x**2) / $a);
        $result = sqrt( $result - $b);

        return $result * $signOfX;
    }
}