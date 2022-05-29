<?php

namespace IlicMiljan\WeightedRatings\Collection;

use IlicMiljan\WeightedRatings\Exception\InvalidTypeException;

interface CollectionInterface
{
    /**
     * Add element to Collection.
     *
     * @param $rating
     * @return mixed
     * @throws InvalidTypeException
     */
    public function add($rating);

    /**
     * Get All elements in Collection.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Get count of elements in Collection.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Returns TRUE when Collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Returns sum of all list elements
     *
     * @return int
     */
    public function sum(): int;
}
