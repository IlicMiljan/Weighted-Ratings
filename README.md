# Weighted Ratings

[![stability-wip](https://img.shields.io/badge/stability-wip-lightgrey.svg)](https://github.com/mkenney/software-guides/blob/master/STABILITY-BADGES.md#work-in-progress)

A lightweight PHP library for calculating the **Wilson Lower Bound Score** and 
**Bayesian Approximation** weights for sorting algorithms based on user feedback.

# Installation
**Weighted Ratings** Library is available via Composer. Just add this line to 
your `composer.json` file:

```
"ilicmiljan/weighted-ratings": "^1.0"
```

or you can run:

```
composer require ilicmiljan/weighted-ratings
```

Note that the `vendor` folder and the `vendor/autoload.php` script are generated 
by Composer and they are not part of Weighted Ratings Library.

# Configuration

TBD

# Usage

### With Default Config Parameters

``` php
$weightCalculator = new RatingWeightCalculator();

$ratingWeight = $weightCalculator->formula(RatingWeightCalculator::FORMULA_WILSON_LOWER_BOUND)
    ->calculateWeight([2,4,6,12,24]);
```

### With Custom Parameters

``` php
$weightCalculator = new RatingWeightCalculator(
    new RatingWeightConfig(RatingWeightCalculator::FORMULA_WILSON_LOWER_BOUND, 5, 0.9)
);

$ratingWeight = $weightCalculator->calculateWeight([2,4,6,12,24,48,92,184,]);
```

# Testing
To run Unit Tests inside this library you can use this command:

```
./vendor/bin/phpunit
```

### Infection PHP Metrics:
- Mutation Score Indicator (MSI): **98%**
- Mutation Code Coverage: **100%**
- Covered Code MSI: **98%**

 
