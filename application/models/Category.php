<?php

namespace app\models;

class Category extends \app\classes\ActiveRecord {
    public static function tableName() {
        return 'category';
    }

    public function behaviors() {
        return [
            'sluggable' => [
                'class' => 'yii\behaviors\SluggableBehavior',
                'attribute' => 'name',
                'ensureUnique' => true,
                'uniqueValidator' => [
                    'targetAttribute' => ['parentId', 'slug']
                ]
            ]
        ];
    }

    public function rules() {
        return [
            ['name', 'required'],
            [['name', 'slug'], 'string', 'length' => [2, 50]],
            ['name', 'unique', 'targetAttribute' => ['parentId', 'name']],
            ['parentId', 'integer'],
            ['parentId', 'exist', 'targetAttribute' => 'id']
        ];
    }

    public function getParent() {
        return $this->hasOne(self::className(), ['id' => 'parentId']);
    }

    public function getChildren() {
        return $this->hasMany(self::className(), ['parentId' => 'id']);
    }

    public function getProducts() {
        return $this->hasMany(Product::className(), ['categoryId' => 'id']);
    }
}