<?php

namespace IlicMiljan\WeightedRatings\Config;

use IlicMiljan\WeightedRatings\Exception\InvalidConfigurationException;

class RatingWeightConfig
{
    private const DEFAULT_ASSUME_NEGATIVE_RATING_IS_LESS_THAN = 3;
    private const DEFAULT_CONFIDENCE = 0.95;

    private ?string $formula;
    private float $confidence;
    private int $assumeNegativeRatingIsLessThan;

    /**
     * @throws InvalidConfigurationException
     */
    public function __construct(
        ?string $formula = null,
        int $assumeNegativeRatingIsLessThan = self::DEFAULT_ASSUME_NEGATIVE_RATING_IS_LESS_THAN,
        float $confidence = self::DEFAULT_CONFIDENCE
    ) {
        $this->validateConfidence($confidence);
        $this->validateAssumeNegativeRatingIsLessThan($assumeNegativeRatingIsLessThan);

        $this->formula = $formula;
        $this->assumeNegativeRatingIsLessThan = $assumeNegativeRatingIsLessThan;
        $this->confidence = $confidence;
    }

    public function getFormula(): ?string
    {
        return $this->formula;
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function setFormula(string $formula): RatingWeightConfig
    {
        if ($this->formula !== null && $this->formula !== $formula) {
            throw new InvalidConfigurationException("Cannot change formula once it is configured.");
        }

        $this->formula = $formula;
        return $this;
    }

    public function getConfidence(): float
    {
        return $this->confidence;
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function setConfidence(float $confidence): RatingWeightConfig
    {
        $this->validateConfidence($confidence);
        $this->confidence = $confidence;
        return $this;
    }

    public function getAssumeNegativeRatingIsLessThan(): int
    {
        return $this->assumeNegativeRatingIsLessThan;
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function setAssumeNegativeRatingIsLessThan(int $assumeNegativeRatingIsLessThan): RatingWeightConfig
    {
        $this->validateAssumeNegativeRatingIsLessThan($assumeNegativeRatingIsLessThan);
        $this->assumeNegativeRatingIsLessThan = $assumeNegativeRatingIsLessThan;
        return $this;
    }

    /**
     * @throws InvalidConfigurationException
     */
    private function validateConfidence(float $confidence): void
    {
        if ($confidence <= 0 || $confidence >= 1) {
            throw new InvalidConfigurationException("Confidence parameter must be greater than 0 and less than 1.");
        }
    }

    /**
     * @throws InvalidConfigurationException
     */
    private function validateAssumeNegativeRatingIsLessThan(float $assumeNegativeRatingIsLessThan): void
    {
        if ($assumeNegativeRatingIsLessThan <= 0) {
            throw new InvalidConfigurationException("AssumeNegativeRatingIsLessThan parameter must be greater than 0.");
        }
    }
}
