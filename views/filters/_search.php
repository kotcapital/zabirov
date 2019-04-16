<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\FiltersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="filters-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'filter_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'param') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'middle_id') ?>

    <?php // echo $form->field($model, 'subcategory_id') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
