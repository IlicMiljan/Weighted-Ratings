<?php

namespace IlicMiljan\WeightedRatings;

use IlicMiljan\WeightedRatings\Collection\CollectionInterface;
use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\Exception\InvalidConfigurationException;
use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;
use IlicMiljan\WeightedRatings\Formula\AbstractFormula;
use IlicMiljan\WeightedRatings\Formula\BayesianApproximation;
use IlicMiljan\WeightedRatings\Formula\WilsonLowerBound;

class RatingWeightCalculator
{
    public const FORMULA_WILSON_LOWER_BOUND = 'wilson_lower_bound';
    public const FORMULA_BAYESIAN_APPROXIMATION = 'bayesian_approximation';

    private RatingWeightConfig $ratingWeightConfig;

    public function __construct(
        ?RatingWeightConfig $ratingWeightConfig = null
    ) {
        $this->ratingWeightConfig = $ratingWeightConfig ?? new RatingWeightConfig();
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function formula(string $formula): self
    {
        if ($this->ratingWeightConfig->getFormula() !== null) {
            throw new InvalidConfigurationException("Cannot change formula once it is configured.");
        }

        $this->ratingWeightConfig->formula($formula);

        return $this;
    }

    /**
     * @throws InvalidTypeException
     * @throws Exception\EmptyCollectionException
     * @throws InvalidConfigurationException
     */
    public function calculateWeight(array $ratingsCountPerStar): float
    {
        $ratingsCountCollection = new RatingsCountCollection(...$ratingsCountPerStar);

        $formula = $this->loadFormula($ratingsCountCollection);

        return $formula->calculateWeight();
    }

    /**
     * @throws Exception\EmptyCollectionException
     * @throws InvalidConfigurationException
     */
    private function loadFormula(CollectionInterface $collection): AbstractFormula
    {
        if ($this->ratingWeightConfig->getFormula() === null) {
            throw new InvalidConfigurationException("Formula is not configured.");
        }

        if ($this->ratingWeightConfig->getFormula() === self::FORMULA_WILSON_LOWER_BOUND) {
            return new WilsonLowerBound(
                $collection,
                $this->ratingWeightConfig
            );
        }

        if ($this->ratingWeightConfig->getFormula() === self::FORMULA_BAYESIAN_APPROXIMATION) {
            return new BayesianApproximation(
                $collection,
                $this->ratingWeightConfig
            );
        }

        throw new InvalidConfigurationException("Specified formula is not supported.");
    }

    public function getRatingWeightConfig(): RatingWeightConfig
    {
        return $this->ratingWeightConfig;
    }
}
