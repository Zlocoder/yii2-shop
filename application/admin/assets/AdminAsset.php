<?php

namespace admin\assets;

class AdminAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@admin/views/assets';
    public $baseUrl = '@web';
    public $css = [
        'css/admin.css',
    ];
    public $js = [
        'js/admin.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}