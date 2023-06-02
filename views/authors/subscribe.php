<?php

use app\components\repositories\AuthorRepository;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Subscribers $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Подписка';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="subscribe-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-9">
          <p><?= AuthorRepository::getAuthorFioById($model->id_author); ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="form-group">
            <?= Html::submitButton('Подписаться', ['class' => 'btn btn-success']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
