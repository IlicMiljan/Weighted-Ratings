<?php

namespace IlicMiljan\WeightedRatings\Formula;

use IlicMiljan\WeightedRatings\Collection\CollectionInterface;
use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;

class BayesianApproximation implements FormulaInterface
{
    private CollectionInterface $ratings;
    private float $confidence;

    /**
     * @throws EmptyCollectionException
     */
    public function __construct(
        CollectionInterface $ratings,
        float $confidence = self::DEFAULT_CONFIDENCE
    ) {
        if($ratings->isEmpty()) {
            throw new EmptyCollectionException("Collection cannot be empty.");
        }

        $this->ratings = $ratings;
        $this->confidence = $confidence;
    }

    public function calculateWeight(): float
    {
        // TODO: Implement calculateWeight() method.

        return 1.0;
    }
}