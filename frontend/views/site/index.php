<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Property Search</h1>

        <p class="lead">Real estate combinator.</p>

        <p><a class="btn btn-lg btn-success" href="">Get started</a>
            <?= Html::a(Yii::t('app', 'Get started'), 
                        ['/realestate'], 
                        ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="body-content">

    </div>
</div>
<?php

echo Yii::$app->getRequest()->getUserIP();