<?php

namespace app\controllers;

use app\components\repositories\BookRepository;
use app\components\repositories\ReportRepository;
use app\models\Authors;
use app\models\reports\TopAuthors;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;

class ReportsController extends AbstractController
{
    /**
     * ТОП авторов выпустивших больше книг за какой-то год
     * @return string
     */
    public function actionTop()
    {
        $model = new TopAuthors();
        $dataProvider = null;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $repository = new ReportRepository();
                $dataProvider = new ActiveDataProvider([
                    'query' => $repository->getTopAuthors($model->year, $model->count),
                ]);
            }
        }
        $repository = new BookRepository();
        $years = $repository->getYearFromBooks();
        return $this->render('top', [
            'model' => $model,
            'years' => $years,
            'top' => $dataProvider,
        ]);
    }
}
