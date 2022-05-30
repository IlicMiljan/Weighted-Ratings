<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\Exception\InvalidConfigurationException;
use IlicMiljan\WeightedRatings\RatingWeightCalculator;
use PHPUnit\Framework\TestCase;

final class RatingWeightConfigTest extends TestCase
{
    public function testGetFormulaReturnsNull(): void
    {
        $ratingWeightConfig = new RatingWeightConfig();

        $this->assertNull($ratingWeightConfig->getFormula());
    }

    /**
     * @throws InvalidConfigurationException
     */
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

        $ratingWeightConfig->setFormula($formula);

        $this->assertEquals($formula, $ratingWeightConfig->getFormula());
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testGetConfidenceReturnsProperValue(): void
    {
        $confidence = 0.90;
        $ratingWeightConfig = new RatingWeightConfig(null, 3, $confidence);

        $this->assertEquals($confidence, $ratingWeightConfig->getConfidence());
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testConfidenceSetsProperValue(): void
    {
        $confidence = 0.90;
        $ratingWeightConfig = new RatingWeightConfig();

        $ratingWeightConfig->setConfidence($confidence);

        $this->assertEquals($confidence, $ratingWeightConfig->getConfidence());
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testGetAssumeNegativeRatingIsLessThanReturnsProperValue(): void
    {
        $assumeNegativeRatingIsLessThan = 2;
        $ratingWeightConfig = new RatingWeightConfig(null, $assumeNegativeRatingIsLessThan);

        $this->assertEquals($assumeNegativeRatingIsLessThan, $ratingWeightConfig->getAssumeNegativeRatingIsLessThan());
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testAssumeNegativeRatingIsLessThanSetsProperValue(): void
    {
        $assumeNegativeRatingIsLessThan = 2;
        $ratingWeightConfig = new RatingWeightConfig();

        $ratingWeightConfig->setAssumeNegativeRatingIsLessThan($assumeNegativeRatingIsLessThan);

        $this->assertEquals($assumeNegativeRatingIsLessThan, $ratingWeightConfig->getAssumeNegativeRatingIsLessThan());
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testConfidenceValidationWorksProperlyWhenGreaterThanOne(): void
    {
        $confidence = 1.1;
        $ratingWeightConfig = new RatingWeightConfig();

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage("Confidence parameter must be greater than 0 and less than 1.");

        $ratingWeightConfig->setConfidence($confidence);
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testConfidenceValidationWorksProperlyWhenZero(): void
    {
        $confidence = 0;
        $ratingWeightConfig = new RatingWeightConfig();

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage("Confidence parameter must be greater than 0 and less than 1");

        $ratingWeightConfig->setConfidence($confidence);
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testConfidenceValidationWorksProperlyWhenLessThanZero(): void
    {
        $confidence = -0.1;
        $ratingWeightConfig = new RatingWeightConfig();

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage("Confidence parameter must be greater than 0 and less than 1");

        $ratingWeightConfig->setConfidence($confidence);
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testAssumeNegativeRatingIsLessThanValidationWorksProperlyWhenGreaterThanOne(): void
    {
        $assumeNegativeRatingIsLessThan = -1;
        $ratingWeightConfig = new RatingWeightConfig();

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage("AssumeNegativeRatingIsLessThan parameter must be greater than 0.");

        $ratingWeightConfig->setAssumeNegativeRatingIsLessThan($assumeNegativeRatingIsLessThan);
    }
}
