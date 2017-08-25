<?php

namespace admin\models;

use app\models\Category;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class CategoryForm extends \yii\base\Model {
    public $parentId;
    public $name;
    public $slug;

    private $_category;

    public function rules() {
        return [
            [
                'name' , 'required',
                'message' => 'Введите название',
                'on' => ['create', 'update']
            ],
            [
                'name', 'string',
                'max' => 50,
                'tooLong' => 'Превышен лимит символов (50)',
                'on' => ['create', 'update']
            ],
            [
                'slug', 'string',
                'max' => 50,
                'tooLong' => 'Превышен лимит символов (50)',
                'on' => ['update']
            ],
            [
                'parentId', 'exist',
                'targetClass' => Category::className(),
                'targetAttribute' => 'id',
                'message' => 'Такой категории не существует',
                'on' => ['create', 'update']
            ],
            [
                'name', 'unique',
                'targetClass' => Category::className(),
                'targetAttribute' => ['name', 'categoryId'],
                'on' => ['create']
            ],
            [
                'name', 'unique',
                'targetClass' => Category::className(),
                'targetAttribute' => ['name', 'categoryId'],
                'filter' => ['!=', 'id', $this->_category->id],
                'on' => ['update']
            ],
            [
                'slug', 'unique',
                'targetClass' => Category::className(),
                'targetAttribute' => ['parentId', 'slug'],
                'filter' => ['!=', 'id', $this->_category->id],
                'message' => 'Такой ЧПУ уже существует',
                'on' => ['update']
            ],
            [
                'slug', 'match',
                'pattern' => '/^[a-z0-9][a-z0-9 -]*$/',
                'message' => 'ЧПУ может содержать только латинские буквы, цифрыб пробел и тире',
                'on' => ['update']
            ]
        ];
    }

    public function setCategory($category) {
        $this->_category = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function getCategory() {
        return $this->_category;
    }
    
    public function process() {
        if (!$this->validate()) {
            return false;
        }

        $this->_category->scenario = 'safe';
        $this->_category->name = $this->name;
        $this->_category->slug = $this->slug;

        if ($this->_category->save()) {
            return true;
        }
    }
    
}