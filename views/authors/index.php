<?php

use app\models\Authors;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest) : ?>
    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fio',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'visibleButtons'=>[
                    'update'=> function($model){
                          return !Yii::$app->user->isGuest;
                     },
                    'delete'=> function($model){
                        return !Yii::$app->user->isGuest;
                    },
                ],
                'urlCreator' => function ($action, Authors $model, $key, $index, $column) {
                    //return json_encode($action);
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
