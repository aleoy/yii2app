<?php
use common\models\realestate\Property;

$faker = \Faker\Factory::create();

return [
  'apartment central' => [
    'transactionId' => Property::TRANSACTION_SALE,
    'addressId' => 1, //central
    'typeId' => 1, //apartment
    'constructionTypeId' => 1, //brick
    'constructionStageId' => 1, //new
    'sourceId' => 1, //majas.lv
    'sourceUrl' => 'http://www.majas.lv/apartment/riga/property-11118',
    'dateOnMarket' => '2015-01-30 11:59:59',
    'dateOffMarket' => '2015-01-30 12:59:59',
    'title' => $faker->text(60),
    'description' => $faker->text(300),
    'floorArea' => $faker->numberBetween($min = 9, $max = 9000),
    'onFloor' => $faker->randomDigitNotNull,
    'totalFloor' => $faker->randomDigitNotNull,
    'hasLift' => $faker->boolean($chanceOfGettingTrue = 50),
    'rooms' => '3',
    'parking' => '1',
    'price' => '108000.00',
    'otherDetails' => $faker->text(300),
    'createdBy' => 3, //admin
    'createdAt' => '2015-01-30 11:59:59',
    'updatedBy' => 4, //john
    'updatedAt' => '2015-01-30 12:59:59',
  ],
];