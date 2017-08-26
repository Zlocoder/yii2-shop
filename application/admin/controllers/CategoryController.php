<?php

namespace admin\controllers;

use admin\models\CategoryForm;
use app\models\Category;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

class CategoryController extends \admin\classes\Controller {
    public function actionIndex() {
        $filter = new CategoryFilter();
        $filter->load(\Yii::$app->request->get());

        $provider = new ActiveDataProvider([
            'query' => $filter->query,
            'pagination' => [
                'PageSize' => 10,
                'PageSizeParam' => false
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'parentId' => [
                        'asc' => ['parent.name' => SORT_ASC, 'name' => SORT_ASC],
                        'desc' => ['parent.name' => SORT_DESC, 'name' => SORT_ASC],
                        'default' => SORT_ASC
                    ],
                    'name'
                ],
                'defaultOrder' => [
                    'parentId' => SORT_ASC,
                    'name' => SORT_ASC
                ]
            ]
        ]);

        return $this->render('list', [
            'dataProvider' => $provider,
            'filterModel' => $filter
        ]);
    }

    public function actionCreate() {
        $form = new CategoryForm([
            'scenario' => 'create',
            'category' => new Category()
        ]);

        if (\Yii::$app->request->isPost) {
            try {
                $form->load(\Yii::$app->request->post());

                if ($form->process()) {
                    $this->addFlashMessage('Категория сохранена');
                    return $this->redirect(['index']);
                }
            } catch (Exception $e) {
                $this->addFlashError($e->getMessage());
            }
        }
        return $this->render('form', [
            'model' => $form
        ]);
    }

    public function actionUpdate($id) {
        if (!$category = Category::findOne($id)) {
            $this->addFlashError('Категория не найдена.');
            return $this->redirect(['index']);
        }

        $form = new CategoryForm([
            'scenario' => 'update',
            'category' => $category
        ]);

        if (\Yii::$app->request->isPost) {
            try {
                $form->load(\Yii::$app->request->post());

                if ($form->process()) {
                    $this->addFlashMessage('Категория сохранена.');
                    return $this->redirect(['update', 'id' => $form->category->id]);
                }
            } catch (Exception $e) {
                $this->addFlashError($e->getMessage());
            }
        }

        return $this->render('form', [
            'model' => $form
        ]);
    }

    public function actionDelete($id, $deleteAll = false) {
        if (!$category = Category::findOne($id)) {
            $this->addFlashError('Категория не найдена.');
            return $this->redirect(['index']);
        }

        $category->delete();
        $this->addFlashMessage('Категория удалена.');
        return $this->render(['index']);
    }
 }