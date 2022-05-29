<?php

namespace IlicMiljan\WeightedRatings\Collection;

use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;

class RatingsCountCollection implements CollectionInterface
{
    /** @var int[] $list */
    private array $list;

    /**
     * @param mixed ...$ratings
     * @throws InvalidTypeException
     */
    public function __construct(...$ratings)
    {
        $this->validateElement(...$ratings);
        $this->list = $ratings;
    }

    /**
     * @inheritDoc
     * @param int $rating
     */
    public function add($rating): void
    {
        $this->validateElement($rating);
        $this->list[] = $rating;
    }

    /**
     * @inheritDoc
     * @return int[]
     */
    public function all(): array
    {
        return $this->list;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->list);
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return count($this->all()) === 0;
    }

    /**
     * @inheritDoc
     */
    public function sum(): int
    {
        return array_sum($this->list);
    }

    /**
     * @param mixed ...$elements
     * @return void
     * @throws InvalidTypeException
     */
    private function validateElement(...$elements): void
    {
        foreach ($elements as $element) {
            if (!is_int($element)) {
                throw new InvalidTypeException(
                    "Collection element must be of the type int, " . gettype($element) . " given."
                );
            }
        }
    }
}
