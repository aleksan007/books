<?php

use app\components\repositories\AuthorRepository;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\reports\TopAuthors $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="authors-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'year')->dropDownList($years) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'count')->textInput() ?>
        </div>
    </div>





    <br>
    <div class="row">
        <div class="form-group">
            <?= Html::submitButton('Показать', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
if ($top) {

    echo GridView::widget([
        'dataProvider' => $top,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fio',
            [
                'label'=>'Количество книг',
                'value'=>'count',
            ],
            ]
    ]);
}
