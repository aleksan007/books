<?php

declare(strict_types=1);

namespace app\components\repositories;

use app\components\service\SmsService;
use app\models\Authors;
use app\models\Books;
use app\models\BooksAuthors;
use app\models\Subscribers;


final class SubscriberRepository
{
   public function sendSms(Subscribers $subscriber, Books $book, BooksAuthors $author): void
   {
        $service = SmsService::getInstance();

        $fio = AuthorRepository::getAuthorFioById($author->id_author);
        $message = "{$fio} выпустил новую книгу: {$book->name}";

        $service->send($subscriber->phone, $message);
   }

}