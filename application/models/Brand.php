<?php

namespace app\models;

class Brand extends \app\classes\ActiveRecord {
    public static function tableName() {
        return 'brand';
    }

    public function behaviors() {
        return [
            'sluggable' => [
                'class' => 'yii\behaviors\SluggableBehavior',
                'attribute' => 'name',
                'ensureUnique' => 'true'
            ]
        ];
    }

    public function rules() {
        return [
            ['name', 'required'],
            [['name', 'slug'], 'string', 'length' => [2, 50]],
            ['name', 'unique'],
        ];
    }
}