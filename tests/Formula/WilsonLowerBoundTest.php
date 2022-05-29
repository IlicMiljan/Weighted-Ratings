<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;
use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;
use IlicMiljan\WeightedRatings\Formula\WilsonLowerBound;
use PHPUnit\Framework\TestCase;

final class WilsonLowerBoundTest extends TestCase
{
    public function testEmptyCollectionInstantiatedFormulaThrowsException(): void
    {
        $this->expectException(EmptyCollectionException::class);

        $wilsonLowerBound = new WilsonLowerBound(new RatingsCountCollection(), new RatingWeightConfig());
    }

    /**
     * @throws EmptyCollectionException|InvalidTypeException
     */
    public function testCalculateWeightReturnsCorrectValue(): void
    {
        $wilsonLowerBound = new WilsonLowerBound(new RatingsCountCollection(...[10,15]), new RatingWeightConfig());

        $this->assertEquals(0.0, $wilsonLowerBound->calculateWeight());
    }
}