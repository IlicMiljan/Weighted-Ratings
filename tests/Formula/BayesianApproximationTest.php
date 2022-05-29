<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;
use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;
use IlicMiljan\WeightedRatings\Formula\BayesianApproximation;
use PHPUnit\Framework\TestCase;

final class BayesianApproximationTest extends TestCase
{
    public function testEmptyCollectionInstantiatedFormulaThrowsException(): void
    {
        $this->expectException(EmptyCollectionException::class);

        $bayesianApproximation = new BayesianApproximation(new RatingsCountCollection());
    }

    /**
     * @throws EmptyCollectionException|InvalidTypeException
     */
    public function testCalculateWeightReturnsCorrectValue(): void
    {
        $bayesianApproximation = new BayesianApproximation(new RatingsCountCollection(...[10,15]));

        $this->assertEquals(1.0, $bayesianApproximation->calculateWeight());
    }
}