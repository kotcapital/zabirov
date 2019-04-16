<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;
use app\models\Catalog;
use app\models\Category;
use app\models\Middle;
use app\models\Filters;


$param = Catalog::getMapParameters();
$category = Category::getTypeMap();
$middle = Middle::getTypeMap();
$type = Filters::getTypeArray();
?>

<div class="filters-form">

    <?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'type')->dropDownList($type, ['prompt' => 'Тип']) ?>

		<?= $form->field($model, 'name2')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'param')->dropDownList($param, ['prompt' => 'Параметры']) ?>

		<?= $form->field($model, 'category_id')->dropDownList($category, ['prompt' => 'Категория']) ?>

		<?= $form->field($model, 'middle_id')->dropDownList($middle, ['prompt' => 'Подкатегория']) ?>

		<?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Записать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
