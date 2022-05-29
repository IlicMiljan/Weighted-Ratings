<?php

namespace IlicMiljan\WeightedRatings\Formula;

use IlicMiljan\WeightedRatings\Collection\CollectionInterface;
use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;

class BayesianApproximation implements FormulaInterface
{
    private CollectionInterface $ratings;
    private RatingWeightConfig $ratingWeightConfig;

    /**
     * @throws EmptyCollectionException
     */
    public function __construct(
        CollectionInterface $ratings,
        RatingWeightConfig $ratingWeightConfig
    ) {
        if($ratings->isEmpty()) {
            throw new EmptyCollectionException("Collection cannot be empty.");
        }

        $this->ratings = $ratings;
        $this->ratingWeightConfig = $ratingWeightConfig;
    }

    public function calculateWeight(): float
    {
        // TODO: Implement calculateWeight() method.

        return 1.0;
    }
}