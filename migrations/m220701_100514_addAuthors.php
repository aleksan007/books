<?php

use yii\db\Migration;

/**
 * Добавление авторов
 */
class m220701_100514_addAuthors extends Migration
{
    public function safeUp(): void
    {
       $authors = [
           'Пушкин Александр Сергеевич',
           'Виктор Гюго',
           'Лев Толстой',
           'Николай Гоголь',
       ];

       foreach ($authors as $author)
       {
           $this->addAuthor($author);
       }
    }

    private function addAuthor(string $fio): void
    {
        $this->insert('authors', ['fio'=>$fio]);
    }
}
