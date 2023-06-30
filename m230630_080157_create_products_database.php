<?php

use yii\db\Migration;

/**
 * Class m230630_073300_create_database
 */
class m230630_080157_create_products_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'price' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'image' => $this->string(100)->notNull(),
        ]);

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
        ]);

        $this->createTable('collection', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
        ]);

        $this->createTable('collection_item', [
            'id' => $this->primaryKey(),
            'collection_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'number' => $this->string(12)->notNull(),
            'message' => $this->string(500)->notNull(),
        ]);

        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'number' => $this->string(12)->notNull(),
            'email' => $this->string(100)->notNull(),
            'method' => $this->string(50)->notNull(),
            'address' => $this->string(500)->notNull(),
            'total_products' => $this->string(1000)->notNull(),
            'total_price' => $this->integer()->notNull(),
            'placed_on' => $this->string(50)->notNull(),
            'payment_status' => $this->string(20)->notNull()->defaultValue('pending'),
        ]);

        $this->createTable('order_item', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'price' => $this->integer()->notNull(),
            'image' => $this->string(100)->notNull(),
            'description' => $this->string(500)->notNull(),
            'pdf_file' => $this->string(100)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'qr_code' => $this->string(100)->notNull(),
        ]);

        $this->createTable('product_rating', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'rating' => $this->integer()->notNull(),
            'rated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createTable('product_views', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'viewed_at' => $this->dateTime()->notNull(),
        ]);

        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'password' => $this->string(100)->notNull(),
            'user_type' => $this->string(20)->notNull()->defaultValue('user'),
        ]);

        $this->addForeignKey('fk_cart_products', 'cart', 'id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_cart_users', 'cart', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_collection_item_collection', 'collection_item', 'collection_id', 'collection', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_collection_item_products', 'collection_item', 'product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_item_order', 'order_item', 'order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_order_item_products', 'order_item', 'product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_orders_users', 'orders', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_product_category', 'products', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_product_rating_product', 'product_rating', 'product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_product_rating_users', 'product_rating', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_product_views_product', 'product_views', 'product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_product_views_users', 'product_views', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_cart_products', 'cart');
        $this->dropForeignKey('fk_cart_users', 'cart');
        $this->dropForeignKey('fk_collection_item_collection', 'collection_item');
        $this->dropForeignKey('fk_collection_item_products', 'collection_item');
        $this->dropForeignKey('fk_order_item_order', 'order_item');
        $this->dropForeignKey('fk_order_item_products', 'order_item');
        $this->dropForeignKey('fk_orders_users', 'orders');
        $this->dropForeignKey('fk_product_category', 'products');
        $this->dropForeignKey('fk_product_rating_product', 'product_rating');
        $this->dropForeignKey('fk_product_rating_users', 'product_rating');
        $this->dropForeignKey('fk_product_views_product', 'product_views');
        $this->dropForeignKey('fk_product_views_users', 'product_views');

        $this->dropTable('cart');
        $this->dropTable('category');
        $this->dropTable('collection');
        $this->dropTable('collection_item');
        $this->dropTable('message');
        $this->dropTable('orders');
        $this->dropTable('order_item');
        $this->dropTable('products');
        $this->dropTable('product_rating');
        $this->dropTable('product_views');
        $this->dropTable('users');
    }
}