<?php

namespace IlicMiljan\WeightedRatings\Formula;

final class Average extends AbstractFormula
{
    public function calculateWeight(): float
    {
        if ($this->ratings->sum() === 0) {
            return 0.0;
        }

        $ratingsSum = 0;

        foreach ($this->ratings->all() as $index => $count) {
            $ratingsSum += ($index + 1) * $count;
        }

        return $ratingsSum / $this->ratings->sum();
    }
}
