<?php

use yii\db\Migration;

/**
 * Подписчики
 */
class m220701_100515_addSubscribers extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('subscribers', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(12)->notNull(),
            'id_author' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-subscribers', 'subscribers', ['phone','id_author'], true);

        $this->addForeignKey(
            'subscribers_fk',
            'subscribers',
            'id_author',
            'authors',
            'id',
            'cascade',
            'cascade'
        );
    }

}
