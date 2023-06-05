<?php

declare(strict_types=1);

namespace app\components\repositories;

use app\models\Authors;
use app\models\Books;
use app\models\BooksAuthors;
use yii\helpers\ArrayHelper;

/**
 * Репозиторий для авторов
 * Class AuthorRepository
 * @package app\components\repositories
 */
final class AuthorRepository
{
    /**
     * Получение всех авторов в виде массива
     * @return array
     */
    public static function getAuthorsList(): array
    {
        $authors = Authors::find()->all();

        return ArrayHelper::map($authors, 'id', 'fio');
    }

    /**
     * Возвращает фио автора
     * @param int $id
     * @return string|null
     */
    public static function getAuthorFioById(int $id): ?string
    {
        $author = Authors::findOne($id);
        return $author ? $author->fio : null;
    }

    /**
     * Устанавливает автора для книги
     * @param Books $book
     */
    public static function setAuthors(Books $book)
    {
        BooksAuthors::deleteAll(['id_book'=>$book->id]);

        foreach ($book->idAuthor as $author)
        {
            $newBookAuthor = new BooksAuthors();
            $newBookAuthor->id_book = $book->id;
            $newBookAuthor->id_author= $author;
            $newBookAuthor->save();
        }

    }

}