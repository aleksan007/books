<?php

use yii\db\Migration;

/**
 * Добавляет книги
 */
class m220701_100511_books extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull(),
            'year' => $this->integer()->notNull(),
            'isbn' => $this->string(50)->notNull(),
            'photo' => $this->text()->notNull(),
            'description' => $this->string(300)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-books', 'books', ['isbn'], true);
    }


    public function safeDown(): void
    {
        $this->dropTable('books');
    }
}
