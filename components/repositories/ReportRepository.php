<?php

declare(strict_types=1);

namespace app\components\repositories;

use app\models\Authors;
use app\models\Books;
use app\models\BooksAuthors;
use app\models\Subscribers;

/**
 * Репозиторий для отчетов
 * Class ReportRepository
 * @package app\components\repositories
 */
final class ReportRepository
{
    /**
     * Получение ТОП авторов выпустивших больше книг за какой-то год
     * @param int $year
     * @param int $top
     * @return \yii\db\ActiveQuery
     */
    public function getTopAuthors(int $year, int $top = 10)
   {
        return Authors::find()->select('authors.fio, count(*) as count')
            ->joinWith('booksAuthors.book')
            ->where(['year'=>$year])
            ->groupBy('authors.id')
            ->limit($top);
   }

}