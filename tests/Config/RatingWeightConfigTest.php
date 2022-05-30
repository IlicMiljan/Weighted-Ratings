<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\RatingWeightCalculator;
use PHPUnit\Framework\TestCase;

final class RatingWeightConfigTest extends TestCase
{
    public function testGetFormulaReturnsNull(): void
    {
        $ratingWeightConfig = new RatingWeightConfig();

        $this->assertNull($ratingWeightConfig->getFormula());
    }

    public function testGetFormulaReturnsString(): void
    {
        $formula = RatingWeightCalculator::FORMULA_WILSON_LOWER_BOUND;
        $ratingWeightConfig = new RatingWeightConfig($formula);

        $this->assertEquals($formula, $ratingWeightConfig->getFormula());
    }

    public function testFormulaSetsProperValue(): void
    {
        $formula = RatingWeightCalculator::FORMULA_WILSON_LOWER_BOUND;
        $ratingWeightConfig = new RatingWeightConfig();

        $this->assertNull($ratingWeightConfig->getFormula());

        $ratingWeightConfig->formula($formula);

        $this->assertEquals($formula, $ratingWeightConfig->getFormula());
    }

    public function testGetConfidenceReturnsProperValue(): void
    {
        $confidence = 0.90;
        $ratingWeightConfig = new RatingWeightConfig(null, 3, $confidence);

        $this->assertEquals($confidence, $ratingWeightConfig->getConfidence());
    }

    public function testConfidenceSetsProperValue(): void
    {
        $confidence = 0.90;
        $ratingWeightConfig = new RatingWeightConfig();

        $ratingWeightConfig->confidence($confidence);

        $this->assertEquals($confidence, $ratingWeightConfig->getConfidence());
    }

    public function testGetAssumeNegativeRatingIsLessThanReturnsProperValue(): void
    {
        $assumeNegativeRatingIsLessThan = 2;
        $ratingWeightConfig = new RatingWeightConfig(null, $assumeNegativeRatingIsLessThan);

        $this->assertEquals($assumeNegativeRatingIsLessThan, $ratingWeightConfig->getAssumeNegativeRatingIsLessThan());
    }

    public function testAssumeNegativeRatingIsLessThanSetsProperValue(): void
    {
        $assumeNegativeRatingIsLessThan = 2;
        $ratingWeightConfig = new RatingWeightConfig();

        $ratingWeightConfig->assumeNegativeRatingIsLessThan($assumeNegativeRatingIsLessThan);

        $this->assertEquals($assumeNegativeRatingIsLessThan, $ratingWeightConfig->getAssumeNegativeRatingIsLessThan());
    }
}
