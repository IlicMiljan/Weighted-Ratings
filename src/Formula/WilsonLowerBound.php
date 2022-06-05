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

        $z = $this->calculateZ($this->ratingWeightConfig->getConfidence());
        $positiveRatingRatio = 1.0 * $positiveRatingsCount / $ratingsCount;

        return ($positiveRatingRatio + $z * $z / (2 * $ratingsCount) - $z
                * sqrt(($positiveRatingRatio * (1 - $positiveRatingRatio) + $z
                        * $z / (4 * $ratingsCount)) / $ratingsCount)) / (1 + $z * $z / $ratingsCount);
    }

    private function calculateZ(float $confidence): float
    {
        return MathHelper::percentPointFunction(1 - (1 - $confidence) / 2);
    }
}
