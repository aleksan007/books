<?php

namespace app\controllers;

use app\models\Authors;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class AbstractController extends Controller
{
    public $layout = 'main';
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['update', 'create','delete'],
                    'rules' => [
                        /*[
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['?'],
                        ],*/
                        [
                            'allow' => true,
                            'actions' => ['update','create','delete'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
}
