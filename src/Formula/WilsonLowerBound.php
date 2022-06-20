<?php

namespace IlicMiljan\WeightedRatings\Formula;

use IlicMiljan\WeightedRatings\Helper\MathHelper;

final class WilsonLowerBound extends AbstractFormula
{
    public function calculateWeight(): float
    {
        if ($this->ratings->sum() === 0) {
            return 0.0;
        }

        $ratingsCount = $this->ratings->sum();
        $positiveRatingsCount = $this->ratings->sumFromIndex(
            $this->ratingWeightConfig->getAssumeNegativeRatingIsLessThan()
        );

        $medianOfDistribution = $this->calculateZ($this->ratingWeightConfig->getConfidence());
        $positiveRatingRatio = 1.0 * $positiveRatingsCount / $ratingsCount;

        return ($positiveRatingRatio + $medianOfDistribution * $medianOfDistribution / (2 * $ratingsCount)
                - $medianOfDistribution * sqrt(($positiveRatingRatio * (1 - $positiveRatingRatio)
                + $medianOfDistribution * $medianOfDistribution / (4 * $ratingsCount)) / $ratingsCount))
                / (1 + $medianOfDistribution * $medianOfDistribution / $ratingsCount);
    }

    private function calculateZ(float $confidence): float
    {
        return MathHelper::percentPointFunction(1 - (1 - $confidence) / 2);
    }
}
