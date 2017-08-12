<?php

namespace site\controllers;

class SiteController extends \app\classes\Controller {
    public function actionIndex() {
        return $this->render('/index');
    }
}