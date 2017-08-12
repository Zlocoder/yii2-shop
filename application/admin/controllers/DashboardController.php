<?php

namespace admin\controllers;

class DashboardController extends \admin\classes\Controller {
    public function actionIndex() {
        return $this->render('/dashboard');
    }
}