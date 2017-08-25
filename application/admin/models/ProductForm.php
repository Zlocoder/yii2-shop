<?php

namespace admin\models;

use app\models\Brand;
use app\models\Product;
use app\models\Category;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class ProductForm extends \yii\base\Model {
    public $name;
    public $model;
    public $slug;
    public $categoryId;
    public $brandId;
    public $quantity;
    public $markQuantity;
    public $markSum;
    public $description;

    private $_product;

    public function rules() {
        return [
            [
                'name', 'required',
                'message' => 'Введите название продукта.',
                'on' => ['create', 'update']
            ],
            [
                'model', 'required',
                'message' => 'Введите название модели.',
                'on' => ['create', 'update']
            ],
            [
                'quantity', 'required',
                'message' => 'Введите количество продуктов.',
                'on' => ['create', 'update']
            ],
            [
                'markQuantity', 'required',
                'message' => 'Введите оценку продукта.',
                'on' => ['create', 'update']
            ],
            [
                'description', 'required',
                'message' => 'Введите описание.',
                'on' => ['create', 'update']
            ],
            [
                ['name', 'model'], 'string',
                'max' => 50,
                'message' => 'Превышен лимит вводимых символов(50).',
                'on' => ['create', 'update']
            ],
            [
                'slug', 'string',
                'max' => 50,
                'message' => 'Превышен лимит вводимых символов(50).',
                'on' => ['update']
            ],
            [
                ['quantity', 'markQuantity', 'markSum'], 'integer',
                'on' => ['create', 'update']
            ],
            [
                'categoryId', 'exist',
                'targetClass' => Category::className(),
                'targetAttribuite' => 'id',
                'message' => 'Такой категории не существует.',
                'on' => ['create', 'update']
            ],
            [
                'brandId', 'exist',
                'targetClass' => Brand::className(),
                'targetAttribuite' => 'id',
                'message' => 'Такой категории не существует.',
                'on' => ['create', 'update']
            ],
            [
                'model', 'unique',
                'targetClass' => Product::className(),
                'targetAttribute' => ['model', 'brandId'],
                'message' => 'Такая модель уже существует',
                'on' => ['create']
            ],
            [
                'model', 'unique',
                'targetClass' => Product::className(),
                'targetAttribute' => ['model', 'brandId'],
                'filter' => ['!=', 'id', $this->_product->id],
                'message' => 'Такая модель уже существует',
                'on' => ['update']
            ],
            [
                'slug', 'unique',
                'targetClass' => Product::className(),
                'targetAttribute' => ['slug', 'brandId'],
                'filter' => ['!=', 'id', $this->_product->id],
                'message' => 'Такой ЧПУ уже существует',
                'on' => ['update']
            ],
            [
                'slug', 'match',
                'pattern' => '/^[a-z0-9][a-z0-9 -]*$/',
                'message' => 'ЧПУ может содержать только латинские буквы, цифры, пробел и тире.',
                'on' => ['update']
            ]
        ];
    }

    public function setProduct($product) {
        $this->_product = $product;
        $this->name = $this->product->name;
        $this->model = $this->product->model;
        $this->slug = $this->product->slug;
        $this->quantity = $this->product->quantity;
        $this->markQuantity = $this->product->markQuantity;
        $this->markSum = $this->product->markSum;
        $this->description = $this->product->description;
    }

    public function getProduct() {
        return $this->_product;
    }

    public function process() {
        if (!$this->validate()) {
            return false;
        }

        $this->_product->scenario = 'safe';
        $this->_product->name = $this->name;
        $this->_product->model = $this->model;
        $this->_product->slug = $this->slug;
        $this->_product->quantity = $this->quantity;
        $this->_product->markQuantity = $this->markQuantity;
        $this->_product->markSum = $this->markSum;
        $this->_product->description = $this->description;

        if ($this->_product->save()) {
            return true;
        }
    }
}