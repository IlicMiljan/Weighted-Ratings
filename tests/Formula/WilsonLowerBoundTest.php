<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;
use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;
use IlicMiljan\WeightedRatings\Formula\BayesianApproximation;
use IlicMiljan\WeightedRatings\Formula\WilsonLowerBound;
use PHPUnit\Framework\TestCase;

final class WilsonLowerBoundTest extends TestCase
{
    public function testEmptyCollectionInstantiatedFormulaThrowsException(): void
    {
        $this->expectException(EmptyCollectionException::class);

        $wilsonLowerBound = new WilsonLowerBound(new RatingsCountCollection());
    }

    /**
     * @throws EmptyCollectionException|InvalidTypeException
     */
    public function testCalculateWeightReturnsCorrectValue(): void
    {
        $wilsonLowerBound = new WilsonLowerBound(new RatingsCountCollection(...[10,15]));

        $this->assertEquals(1.0, $wilsonLowerBound->calculateWeight());
    }
}