<?php

namespace IlicMiljan\WeightedRatings\Formula;

interface FormulaInterface
{
    const DEFAULT_CONFIDENCE = 0.95;

    public function calculateWeight(): float;
}