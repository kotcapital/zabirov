<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'goods_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'sys_id') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'keyword')->textarea(['rows' => 4]) ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'middle_id') ?>

    <?php // echo $form->field($model, 'subcategory_id') ?>

    <?php // echo $form->field($model, 'manufacture_id') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'i1') ?>

    <?php // echo $form->field($model, 'i2') ?>

    <?php // echo $form->field($model, 'i3') ?>

    <?php // echo $form->field($model, 'd1') ?>

    <?php // echo $form->field($model, 'd2') ?>

    <?php // echo $form->field($model, 'd3') ?>

    <?php // echo $form->field($model, 'subtype1') ?>

    <?php // echo $form->field($model, 'subtype2') ?>

    <?php // echo $form->field($model, 'subtype3') ?>

    <?php // echo $form->field($model, 'vch1') ?>

    <?php // echo $form->field($model, 'vch2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
