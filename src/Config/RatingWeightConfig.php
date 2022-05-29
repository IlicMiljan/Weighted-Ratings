<?php

namespace IlicMiljan\WeightedRatings\Config;

class RatingWeightConfig
{
    private ?string $formula;
    private float $confidence;
    private int $assumeNegativeRatingIsLessThan;

    /**
     * @param ?string $formula
     * @param int $assumeNegativeRatingIsLessThan
     * @param float $confidence
     */
    public function __construct(
        ?string $formula = null,
        int $assumeNegativeRatingIsLessThan = 3,
        float $confidence = 0.95
    ) {
        $this->formula = $formula;
        $this->assumeNegativeRatingIsLessThan = $assumeNegativeRatingIsLessThan;
        $this->confidence = $confidence;
    }

    /**
     * @return string|null
     */
    public function getFormula(): ?string
    {
        return $this->formula;
    }

    /**
     * @param string $formula
     * @return RatingWeightConfig
     */
    public function formula(string $formula): RatingWeightConfig
    {
        $this->formula = $formula;
        return $this;
    }

    /**
     * @return float
     */
    public function getConfidence(): float
    {
        return $this->confidence;
    }

    /**
     * @param float $confidence
     * @return RatingWeightConfig
     */
    public function confidence(float $confidence): RatingWeightConfig
    {
        $this->confidence = $confidence;
        return $this;
    }

    /**
     * @return int
     */
    public function getAssumeNegativeRatingIsLessThan(): int
    {
        return $this->assumeNegativeRatingIsLessThan;
    }

    /**
     * @param int $assumeNegativeRatingIsLessThan
     * @return RatingWeightConfig
     */
    public function assumeNegativeRatingIsLessThan(int $assumeNegativeRatingIsLessThan): RatingWeightConfig
    {
        $this->assumeNegativeRatingIsLessThan = $assumeNegativeRatingIsLessThan;
        return $this;
    }
}
