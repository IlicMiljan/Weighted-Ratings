<?php

namespace IlicMiljan\WeightedRatings\Formula;

use IlicMiljan\WeightedRatings\Helper\MathHelper;

final class BayesianApproximation extends AbstractFormula
{
    public function calculateWeight(): float
    {
        if ($this->ratings->sum() === 0) {
            return 0.0;
        }

        $ratingsCount = $this->ratings->count();
        $medianOfDistribution = $this->calculateZ($this->ratingWeightConfig->getConfidence());
        $ratingsSum = $this->ratings->sum();

        $firstPart = 0.0;
        $secondPart = 0.0;

        foreach ($this->ratings->all() as $index => $value) {
            $firstPart += ($index + 1) * ($value + 1) / ($ratingsSum + $ratingsCount);
            $secondPart += ($index + 1) * ($index + 1) * ($value + 1) / ($ratingsSum + $ratingsCount);
        }

        return $firstPart - $medianOfDistribution
            * sqrt(($secondPart - $firstPart ** 2) / ($ratingsSum + $ratingsCount + 1));
    }

    private function calculateZ(float $confidence): float
    {
        return MathHelper::percentPointFunction(1 - (1 - $confidence) / 2);
    }
}
