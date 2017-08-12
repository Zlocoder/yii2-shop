<?php

namespace app\classes;

class View extends \yii\web\View {
    public function getChunkPath() {
        return \Yii::$app->controller->module->viewPath . '/../chunks/';
    }


    public function chunk($name, $params = []) {
        return $this->renderPhpFile(\Yii::getAlias("{$this->chunkPath}/{$name}.php"), $params);
    }
}