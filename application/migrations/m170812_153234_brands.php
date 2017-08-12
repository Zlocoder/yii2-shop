<?php

use yii\db\Migration;

class m170812_153234_brands extends Migration
{
    public function safeUp()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'slug' => $this->string(50)->notNull()
        ]);

        $this->createIndex('brand_name', 'brand', 'name', true);
        $this->createIndex('brand_slug', 'brand', 'slug', true);
    }

    public function safeDown()
    {
        $this->dropTable('brand');
    }
}
