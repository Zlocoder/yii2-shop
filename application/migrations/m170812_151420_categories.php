<?php

use yii\db\Migration;

class m170812_151420_categories extends Migration
{
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'parentId' => $this->integer(),
            'name' => $this->string(50)->notNull(),
            'slug' => $this->string(50)->notNull(),
            'created' => $this->dateTime()->notNull(),
            'updated' => $this->dateTime()->notNull()
        ]);

        $this->createIndex('category_parentId_name', 'category', ['parentId', 'name'], true);
        $this->createIndex('category_parentId_slug', 'category', ['parentId', 'slug'], true);

        $this->addForeignKey('category_parentId_FK', 'category', 'parentId', 'category', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('category');
    }
}
