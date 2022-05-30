<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;
use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;
use IlicMiljan\WeightedRatings\Formula\BayesianApproximation;
use PHPUnit\Framework\TestCase;

final class BayesianApproximationTest extends TestCase
{
    public function testEmptyCollectionInstantiatedFormulaThrowsException(): void
    {
        $this->expectException(EmptyCollectionException::class);

        $bayesianApproximation = new BayesianApproximation(new RatingsCountCollection(), new RatingWeightConfig());
    }

    /**
     * @throws EmptyCollectionException|InvalidTypeException
     */
    public function testCalculateWeightReturnsCorrectValue(): void
    {
        $bayesianApproximation = new BayesianApproximation(
            new RatingsCountCollection(...[10,15]),
            new RatingWeightConfig()
        );

        $this->assertEquals(1.4108568650726, $bayesianApproximation->calculateWeight());
    }

    /**
     * @throws EmptyCollectionException
     * @throws InvalidTypeException
     */
    public function testCalculateWeightReturnsCorrectValueWhenNoRatings(): void
    {
        $bayesianApproximation = new BayesianApproximation(
            new RatingsCountCollection(...[0,0]),
            new RatingWeightConfig()
        );

        $this->assertEquals(0.0, $bayesianApproximation->calculateWeight());
    }
}