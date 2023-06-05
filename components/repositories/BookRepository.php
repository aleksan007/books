<?php

declare(strict_types=1);

namespace app\components\repositories;

use app\models\Books;
use app\models\BooksAuthors;
use app\models\Subscribers;
use yii\helpers\ArrayHelper;

/**
 * Class BookRepository
 * @package app\components\repositories
 */
final class BookRepository
{
   public function sendToSubscribersSms(Books $book)
   {
       $authors = $book->booksAuthors;
       /** @var BooksAuthors $author */
       $repository = new SubscriberRepository();
       foreach ($authors as $author) {
           $idAuthor = $author->id_author;
           $subscribers = Subscribers::find()->where(['id_author'=>$idAuthor])->all();
           /** @var Subscribers $subscriber */

           foreach ($subscribers as $subscriber) {
                $repository->sendSms($subscriber, $book, $author);
           }
       }
   }

    /**
     * Возвращает список лет издания книг
     * @return array
     */
    public function getYearFromBooks(): array
   {
       $books = Books::find()->distinct()->orderBy(['year' => SORT_DESC])->all();
       return ArrayHelper::map($books, 'year','year');
   }

}