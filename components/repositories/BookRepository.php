<?php

declare(strict_types=1);

namespace app\components\repositories;

use app\models\Books;
use app\models\BooksAuthors;
use app\models\Subscribers;


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

}