<?php
use common\models\realestate\PropertySource;
use common\models\realestate\PropertySourceEntryPoint;

return [
  'ss riga apartments' => [
    'sourceId' => PropertySource::findOne(['name'=>'ss.lv'])->id,
    'statusId' => PropertySourceEntryPoint::STATUS_ACTIVE,
    'startedAt' => null,
    'finishedAt' => null,
    'url' => 'https://www.ss.lv/lv/real-estate/flats/riga/all/',
    'currentPage' => null,
    'description' => 'listing of all apartments in riga'
  ],
];