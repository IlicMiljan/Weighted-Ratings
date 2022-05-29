<?php

namespace IlicMiljan\WeightedRatings\Tests\Collection;

use IlicMiljan\WeightedRatings\Collection\RatingsCountCollection;
use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;
use PHPUnit\Framework\TestCase;

final class RatingsCountCollectionTest extends TestCase
{
    public function testEmptyInstantiatedCollectionReturnsNoItems(): void
    {
        $ratingsCountCollection = new RatingsCountCollection();

        $this->assertEmpty($ratingsCountCollection->all());
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCountIsCorrectForItemsPassedIn(): void
    {
        $ratingsCountCollection = new RatingsCountCollection(...[10,15]);

        $this->assertEquals(2, $ratingsCountCollection->count());
    }

    /**
     * @throws InvalidTypeException
     */
    public function testItemsReturnedMatchItemsPassedIn(): void
    {
        $ratingsCountCollection = new RatingsCountCollection(...[10,15]);

        $this->assertCount(2, $ratingsCountCollection->all());
        $this->assertEquals(10, $ratingsCountCollection->all()[0]);
        $this->assertEquals(15, $ratingsCountCollection->all()[1]);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testItemsReturnedMatchAddedItems(): void
    {
        $ratingsCountCollection = new RatingsCountCollection();

        $ratingsCountCollection->add(10);
        $ratingsCountCollection->add(15);

        $this->assertCount(2, $ratingsCountCollection->all());
        $this->assertEquals(10, $ratingsCountCollection->all()[0]);
        $this->assertEquals(15, $ratingsCountCollection->all()[1]);
    }

    public function testIsEmptyReturnsTrueWhenEmpty(): void
    {
        $ratingsCountCollection = new RatingsCountCollection();

        $this->assertEquals(true, $ratingsCountCollection->isEmpty());
    }

    /**
     * @throws InvalidTypeException
     */
    public function testIsEmptyReturnsFalseWhenNotEmpty(): void
    {
        $ratingsCountCollection = new RatingsCountCollection(...[10,15]);

        $this->assertEquals(false, $ratingsCountCollection->isEmpty());
    }

    /**
     * @throws InvalidTypeException
     */
    public function testConstructorThrowsExceptionWhenWrongTypeIsPassedIn(): void
    {
        $this->expectException(InvalidTypeException::class);

        $ratingsCountCollection = new RatingsCountCollection(...[10.5,"15"]);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testAddThrowsExceptionWhenWrongTypeIsPassedIn(): void
    {
        $ratingsCountCollection = new RatingsCountCollection();

        $this->expectException(InvalidTypeException::class);

        $ratingsCountCollection->add(10.5);
    }
}