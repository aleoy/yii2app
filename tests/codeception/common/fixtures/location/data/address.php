<?php

use common\models\location\Neighborhood;

$centrsNeighborhood = Neighborhood::findOne(['name' => 'centrs']);
$neighborhoodId = $centrsNeighborhood->id;
$districtId = $centrsNeighborhood->district->id;
$cityId = $centrsNeighborhood->city->id;

return [
  'central' => [
    'cityId' => $cityId,
    'districtId' => $districtId,
    'neighborhoodId' => $neighborhoodId,
    'streetName' => 'brīvības gatave',
    'streetNumber' => '51',
    'postCode' => 'LV-1011',
    'complement' => 'k2',
    'latitude' => 56.955469,
    'longitude' => 24.120120,
  ],
];