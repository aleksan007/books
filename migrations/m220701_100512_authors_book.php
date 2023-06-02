<?php

use yii\db\Migration;

/**
 * Книги авторов
 */
class m220701_100512_authors_book extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('books_authors', [
            'id' => $this->primaryKey(),
            'id_book' => $this->integer()->notNull(),
            'id_author' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'books_authors_fk',
            'books_authors',
            'id_author',
            'authors',
            'id',
            'cascade',
            'cascade'
        );

        $this->addForeignKey(
            'author_books_fk',
            'books_authors',
            'id_book',
            'books',
            'id',
            'cascade',
            'cascade'
        );
    }

    public function safeDown(): void
    {
        $this->dropTable('books_authors');
    }
}
