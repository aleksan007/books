<?php

use yii\db\Migration;

/**
 * Добавляет пользователей
 */
class m220701_100509_users extends Migration
{

    public function safeUp(): void
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string(15),
            'auth_key' => $this->string(),
            'auth_code' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-user-username', '{{%user}}', 'username', true);
        $this->createIndex('idx-user-email', '{{%user}}', 'email', true);

        $hash = '$2y$10$lFirglH74jkTtwybpCCJqOJiPzMm.3qM9B8GkHWC1/wBY/MZSmpfS';

        $this->insert('user', [
            'username'=>'admin',
            'password_hash' => $hash,
            'status' => 10,
            'email' => 'aleksan007@mail.ru',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
       $this->dropTable('user');
    }
}
