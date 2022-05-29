<?php

namespace IlicMiljan\WeightedRatings\Formula;

use IlicMiljan\WeightedRatings\Collection\CollectionInterface;
use IlicMiljan\WeightedRatings\Helper\MathHelper;

class WilsonLowerBound extends AbstractFormula
{

    public function calculateWeight(): float
    {
        if ($this->ratings->sum() === 0) {
            return 0.0;
        }

        $ratingsCount = $this->countAllRatings($this->ratings);
        $positiveRatingsCount = $this->countPositiveRatings(
            $this->ratings,
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

    // TODO: Create countFromIndex() method in Collection
    private function countPositiveRatings(
        CollectionInterface $collection,
        int $assumeNegativeRatingIsLessThan
    ): int {
        $totalCount = 0;

        for ($i = $assumeNegativeRatingIsLessThan; $i < $collection->count(); $i++) {
            $totalCount += $collection->all()[$i];
        }

        return $totalCount;
    }

    private function countAllRatings(
        CollectionInterface $collection
    ): int {
        $totalCount = 0;

        for ($i = 0; $i < $collection->count(); $i++) {
            $totalCount += $collection->all()[$i];
        }

        return $totalCount;
    }
}
