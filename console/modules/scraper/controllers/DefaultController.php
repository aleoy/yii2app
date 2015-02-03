<?php

namespace console\modules\scraper\controllers;

use yii\console\Controller;

class DefaultController extends Controller
{
    public function actionIndex($message = 'scraper module')
    {
        echo $message . "\n";
    }
}
