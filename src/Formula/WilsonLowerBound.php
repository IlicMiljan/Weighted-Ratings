<?php

namespace IlicMiljan\WeightedRatings\Formula;

use IlicMiljan\WeightedRatings\Collection\CollectionInterface;

class WilsonLowerBound extends AbstractFormula
{

    public function calculateWeight(): float
    {
        if($this->ratings->isEmpty()) {
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

    private function countPositiveRatings(
        CollectionInterface $collection,
        int $assumeNegativeRatingIsLessThan
    ): int {
        $totalCount = 0;

        for($i = $assumeNegativeRatingIsLessThan; $i < $collection->count(); $i++) {
            $totalCount += $collection->all()[$i];
        }

        return $totalCount;
    }

    private function countAllRatings(
        CollectionInterface $collection
    ): int {
        $totalCount = 0;

        for($i = 0; $i < $collection->count(); $i++) {
            $totalCount += $collection->all()[$i];
        }

        return $totalCount;
    }
}
