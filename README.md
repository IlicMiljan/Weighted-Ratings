# Weighted Ratings

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

### Available Formulas

``` php
RatingWeightCalculator::FORMULA_WILSON_LOWER_BOUND
RatingWeightCalculator::FORMULA_BAYESIAN_APPROXIMATION
```

### Optional Configuration Parameters

- `ausmeNegativeRatingisLessThan` - Number of stars in the rating that are assumed as negative (_Default: 3_)
- `confidence` - Statistical Confidence used in Formulas (_Default: 0.95_)

### Without `RatingWeightConfig`

You can use default optional config parameters to calculate weights without instantiating `RateLimiterConfig`.
This can be achieved by setting the `formula` in the instance of `RatingWeightCalculator`.

### Using `RatingWeightConfig`

You can create a new instance of `RatingWeightConfig` with all the parameters and pass it to the `RatingWeightCalculator`.

### Changing Formula

The formula for one instance of `RatingWeightCalculator` can be set only once. Changing formula in the runtime will throw an exception.

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

 
