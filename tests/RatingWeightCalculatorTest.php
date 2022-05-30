<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;
use IlicMiljan\WeightedRatings\Exception\InvalidConfigurationException;
use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;
use IlicMiljan\WeightedRatings\RatingWeightCalculator;
use PHPUnit\Framework\TestCase;

final class RatingWeightCalculatorTest extends TestCase
{
    /**
     * @throws InvalidConfigurationException
     */
    public function testFormulaSetsProperValue(): void
    {
        $formula = RatingWeightCalculator::FORMULA_WILSON_LOWER_BOUND;
        $ratingWeightCalculator = new RatingWeightCalculator();

        $this->assertNull($ratingWeightCalculator->getRatingWeightConfig()->getFormula());

        $ratingWeightCalculator->formula($formula);

        $this->assertEquals($formula, $ratingWeightCalculator->getRatingWeightConfig()->getFormula());
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function testFormulaThrowsExceptionWhenResettingFormula(): void
    {
        $initialFormula = RatingWeightCalculator::FORMULA_WILSON_LOWER_BOUND;
        $newFormula = RatingWeightCalculator::FORMULA_BAYESIAN_APPROXIMATION;
        $ratingWeightCalculator = new RatingWeightCalculator(new RatingWeightConfig($initialFormula));

        $this->expectException(InvalidConfigurationException::class);

        $ratingWeightCalculator->formula($newFormula);
    }

    /**
     * @throws EmptyCollectionException
     * @throws InvalidTypeException
     * @throws InvalidConfigurationException
     */
    public function testCalculateWeightReturnsProperValue(): void
    {
        $formula = RatingWeightCalculator::FORMULA_WILSON_LOWER_BOUND;
        $ratingWeightCalculator = new RatingWeightCalculator(new RatingWeightConfig($formula));

        $weight = $ratingWeightCalculator->calculateWeight([10,15]);

        $this->assertEquals(0.0, $weight);

        $formula = RatingWeightCalculator::FORMULA_BAYESIAN_APPROXIMATION;
        $ratingWeightCalculator = new RatingWeightCalculator(new RatingWeightConfig($formula));

        $weight = $ratingWeightCalculator->calculateWeight([10,15]);

        $this->assertEquals(1.410856865072575, $weight);
    }

    /**
     * @throws EmptyCollectionException
     * @throws InvalidTypeException
     * @throws InvalidConfigurationException
     */
    public function testCalculateWeightThrowsExceptionWhenFormulaIsNotSet(): void
    {
        $ratingWeightCalculator = new RatingWeightCalculator();

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage("Formula is not configured.");

        $ratingWeightCalculator->calculateWeight([10,15]);
    }

    /**
     * @throws EmptyCollectionException
     * @throws InvalidTypeException
     * @throws InvalidConfigurationException
     */
    public function testCalculateWeightThrowsExceptionWhenFormulaIsNotSupported(): void
    {
        $formula = 'not_supported_formula';
        $ratingWeightCalculator = new RatingWeightCalculator(new RatingWeightConfig($formula));

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage("Specified formula is not supported.");

        $ratingWeightCalculator->calculateWeight([10,15]);
    }
}
