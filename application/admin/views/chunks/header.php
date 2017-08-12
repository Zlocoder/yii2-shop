<?php

use yii\helpers\Url;

?>

<header>
    <?php \yii\bootstrap\NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Url::to(['dashboard/index']),
        'options' => [
            'class' => 'navbar navbar-inverse navbar-static-top'
        ]
    ]) ?>

        <?= \yii\bootstrap\Nav::widget([
            'options' => [
                'class' => 'nav navbar-nav'
            ],
            'items' => [

            ]
        ]) ?>

    <?php \yii\bootstrap\NavBar::end() ?>
</header>