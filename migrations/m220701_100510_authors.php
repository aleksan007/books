<?php

use yii\db\Migration;

/**
 * Добавляет авторов
 */
class m220701_100510_authors extends Migration
{

    public function safeUp(): void
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(200)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-user-fio', 'authors', ['fio'], true);
    }


    public function safeDown(): void
    {
        $this->dropTable('authors');
    }
}
