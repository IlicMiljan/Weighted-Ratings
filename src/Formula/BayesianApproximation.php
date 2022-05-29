<?php

namespace IlicMiljan\WeightedRatings\Formula;

use IlicMiljan\WeightedRatings\Helper\MathHelper;

class BayesianApproximation extends AbstractFormula
{

    public function calculateWeight(): float
    {
        if ($this->ratings->sum() === 0) {
            return 0.0;
        }

        $K = $this->ratings->count();
        $z = $this->calculateZ($this->ratingWeightConfig->getConfidence());
        $N = array_sum($this->ratings->all());

        $firstPart = 0.0;
        $secondPart = 0.0;

        foreach ($this->ratings->all() as $index => $value) {
            $firstPart += ($index + 1) * ($value + 1) / ($N + $K);
            $secondPart += ($index + 1) * ($index + 1) * ($value + 1) / ($N + $K);
        }

        return $firstPart - $z * sqrt(($secondPart - $firstPart**2) / ($N + $K + 1));
    }

    private function calculateZ(float $confidence): float
    {
        return MathHelper::percentPointFunction(1 - (1 - $confidence) / 2);
    }
}
