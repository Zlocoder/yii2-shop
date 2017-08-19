<?php
namespace app\models;

class ProductImage extends \app\classes\ActiveRecord {
    public static function tableName() {
        return 'productImage';
    }

    public function rules() {
        return [
            [['productId', 'position'], 'required'],
            [['productId', 'position'], 'integer'],
            ['productId', 'exist', 'targetClass' => Product::className(), 'targetAttribute' => 'id'],
            ['position', 'unique', 'targetAttribute' => ['productId', 'position']]
        ];
    }
}