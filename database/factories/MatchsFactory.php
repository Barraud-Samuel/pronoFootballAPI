<?php

use Faker\Generator as Faker;

$factory->define(App\Matchs::class, function (Faker $faker) {
    return [
        'status' => $faker->word,
        'matchday' => $faker->randomDigit,
        'homeTeamName' => $faker->country,
        'awayTeamName' => $faker->country,
        'result_GoalsHomeTeam' => $faker->randomDigit,
        'result_GoalsAwayTeam' => $faker->randomDigit,
        'halfTime_result_GoalsHomeTeam' => $faker->randomDigit,
        'halfTime_result_GoalsAwayTeam' => $faker->randomDigit,
        'extraTime_result_GoalsHomeTeam' => $faker->randomDigit,
        'extraTime_result_GoalsAwayTeam' => $faker->randomDigit,
        'penaltyShootout_result_GoalsHomeTeam' => $faker->randomDigit,
        'penaltyShootout_result_GoalsAwayTeam' => $faker->randomDigit
    ];
});
