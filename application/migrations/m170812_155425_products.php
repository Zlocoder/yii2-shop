<?php

use yii\db\Migration;

class m170812_155425_products extends Migration
{
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'model' => $this->string(50)->notNull(),
            'slug' => $this->string(50)->notNull(),
            'categoryId' => $this->integer()->notNull(),
            'brandId' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'markQuantity' => $this->integer()->notNull(),
            'markSum' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'created' => $this->dateTime()->notNull(),
            'updated' => $this->dateTime()->notNull()
        ]);

        $this->createIndex('product_model', 'product', 'model', true);
        $this->createIndex('product_slug', 'product', 'slug', true);

        $this->addForeignKey('product_categoryId_FK', 'product', 'categoryId', 'category', 'id');
        $this->addForeignKey('product_brandId_FK', 'product', 'brandId', 'brand', 'id');

        $this->createTable('productImage', [
            'id' => $this->primaryKey(),
            'productId' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull(),
        ]);

        $this->createIndex('productImage_productId_position', 'productImage', ['productId', 'position']);
        $this->addForeignKey('productImage_productId_FK', 'productImage', 'productId', 'product', 'id');

        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()
        ]);

        $this->createIndex('tag_name', 'tag', 'name', true);

        $this->createTable('product_tag', [
            'productId' => $this->integer()->notNull(),
            'tagId' => $this->integer()->notNull()
        ]);

        $this->createIndex('product_tag_productId_tagId', 'product_tag', ['productId', 'tagId'], true);

        $this->addForeignKey('product_tag_productId_FK', 'product_tag', 'productId', 'product', 'id');
        $this->addForeignKey('product_tag_tagId_FK', 'product_tag', 'tagId', 'tag', 'id');

        $this->createTable('productComment', [
            'productId' => $this->integer()->notNull(),
            'name' => $this->string(50)->notNull(),
            'mark' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'created' => $this->dateTime()
        ]);

        $this->addForeignKey('productComment_productId_FK', 'productComment', 'productId', 'product', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('productComment');
        $this->dropTable('product_tag');
        $this->dropTable('tag');
        $this->dropTable('productImage');
        $this->dropTable('product');
    }
}
