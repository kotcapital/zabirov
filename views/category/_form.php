<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;
use app\models\Category;

$type = Category::getTypeArray();
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'sys_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keyword')->textarea(['rows' => 4]) ?>
	
    <?= $form->field($model, 'type')->dropDownList($type) ?>

    <div class="form-group">
        <?= Html::submitButton('Записать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
