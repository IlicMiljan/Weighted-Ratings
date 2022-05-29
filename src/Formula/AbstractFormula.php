<?php

namespace IlicMiljan\WeightedRatings\Formula;

use IlicMiljan\WeightedRatings\Collection\CollectionInterface;
use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;

abstract class AbstractFormula
{
    protected CollectionInterface $ratings;
    protected RatingWeightConfig $ratingWeightConfig;

    /**
     * @throws EmptyCollectionException
     */
    public function __construct(
        CollectionInterface $ratings,
        RatingWeightConfig $ratingWeightConfig
    ) {
        if ($ratings->isEmpty()) {
            throw new EmptyCollectionException("Collection cannot be empty.");
        }

        $this->ratings = $ratings;
        $this->ratingWeightConfig = $ratingWeightConfig;
    }

    abstract public function calculateWeight(): float;
}
