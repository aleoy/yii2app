<?php

use common\models\location\District;

$centralDistrict = District::findOne(['name' => 'central']);

return [
  'centrs' => [
    'districtId' => $centralDistrict->primaryKey,
    'cityId' => $centralDistrict->city->primaryKey,
    'name' => 'centrs'
  ],
];