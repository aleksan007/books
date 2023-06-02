<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Authors $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="authors-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-9">
            <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
        </div>
    </div>



    <div class="row">
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
