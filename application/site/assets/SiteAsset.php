<?php

namespace site\assets;

class SiteAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@site/views/assets';
    public $baseUrl = '@web';
    public $css = [
        'stylesheet/960.css',
        'stylesheet/screen.css',
        'stylesheet/color.css'
    ];
    public $js = [
        'js/shoppica.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
