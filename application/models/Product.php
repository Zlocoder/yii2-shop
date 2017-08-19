<?php
namespace app\models;

class Product extends \app\classes\ActiveRecord {
    public static function tableName() {
        return 'product';
    }

    public function behaviors() {
        return [
            'sluggable' => [
                'class' => 'yii\behaviors\SluggableBehavior',
                'attribute' => 'name',
                'ensureUnique' => true,
                'uniqueValidator' => [
                    'targetAttribute' => ['slug', 'categoryId']
                ]
            ]
        ];
    }

    public function rules() {
        return [
            [['name', 'model', 'slug', 'categoryId', 'brandId', 'quantity', 'markQuantity', 'markSum', 'description'], 'required'],
            [['name', 'model', 'slug'], 'string', 'length' => [2, 50]],
            [['categoryId', 'brandId', 'quantity', 'markQuantity', 'markSum'], 'integer'],
            ['categoryId', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id'],
            ['brandId', 'exist', 'targetClass' => Brand::className(), 'targetAttribute' => 'id'],
            ['model', 'unique'],
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    public function getBrand() {
        return $this->hasOne(Brand::className(), ['id' => 'brandId']);
    }

    public function getImages() {
        return $this->hasMany(ProductImage::className(), ['productId' => 'id'])->orderBy('position');
    }

    public function getCover() {
        return $this->hasOne(ProductImage::className(), ['productId' => 'id'])->where(['position' => 1]);
    }
}