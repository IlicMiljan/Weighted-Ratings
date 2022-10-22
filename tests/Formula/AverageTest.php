<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Config\RatingWeightConfig;
use IlicMiljan\WeightedRatings\Exception\EmptyCollectionException;
use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;
use IlicMiljan\WeightedRatings\Formula\Average;
use PHPUnit\Framework\TestCase;

final class AverageTest extends TestCase
{
    public function testEmptyCollectionInstantiatedFormulaThrowsException(): void
    {
        $this->expectException(EmptyCollectionException::class);
        $this->expectExceptionMessage("Collection cannot be empty.");

        $average = new Average(new RatingsCountCollection(), new RatingWeightConfig());
    }

    /**
     * @throws EmptyCollectionException|InvalidTypeException
     */
    public function testCalculateWeightReturnsCorrectValue(): void
    {
        $average = new Average(
            new RatingsCountCollection(...[10,15]),
            new RatingWeightConfig()
        );

        $this->assertEquals(1.6, $average->calculateWeight());
    }

    /**
     * @throws EmptyCollectionException
     * @throws InvalidTypeException
     */
    public function testCalculateWeightReturnsCorrectValueWhenNoRatings(): void
    {
        $average = new Average(
            new RatingsCountCollection(...[0,0]),
            new RatingWeightConfig()
        );

        $this->assertEquals(0.0, $average->calculateWeight());
    }
}