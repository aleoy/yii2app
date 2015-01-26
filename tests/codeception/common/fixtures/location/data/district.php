<?php

use common\models\location\City;

$riga = City::findOne(['name' => 'riga']);

return [
  'central' => [
    'cityId' => $riga->primaryKey,
    'name' => 'central'
  ],
];