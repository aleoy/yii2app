<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Property Search</h1>

        <p class="lead">Real estate combinator.</p>

        <p>
            <?= Html::a(Yii::t('app', 'Get started'), 
                        ['/realestate/property'], 
                        ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="body-content">

    </div>
</div>
<?php

echo Yii::$app->getRequest()->getUserIP();