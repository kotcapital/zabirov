<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;
use app\models\Catalog;
use app\models\Category;
use app\models\Middle;
use app\models\Manufacture;

$type = Catalog::getTypeArray();
$category = Category::getTypeMap();
$middle = Middle::getTypeMap();
$manufacture = Manufacture::getTypeMap();
$status = Catalog::getStatusArray();
?>

<div class="catalog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'type')->dropDownList($type) ?>
	
	<?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'sys_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keyword')->textarea(['rows' => 4]) ?>

	<?= $form->field($model, 'category_id')->dropDownList($category, ['prompt' => 'Выберите категорию']) ?>

    <?= $form->field($model, 'middle_id')->dropDownList($middle, ['prompt' => 'Выберите подкатегорию']) ?>

    <?= $form->field($model, 'manufacture_id')->dropDownList($manufacture, ['prompt' => 'Выберите производителя']) ?>

    <?= $form->field($model, 'status_id')->dropDownList($status) ?>

    <?= $form->field($model, 'i1')->textInput() ?>

    <?= $form->field($model, 'i2')->textInput() ?>

    <?= $form->field($model, 'i3')->textInput() ?>

    <?= $form->field($model, 'd1')->textInput() ?>

    <?= $form->field($model, 'd2')->textInput() ?>

    <?= $form->field($model, 'd3')->textInput() ?>

    <?= $form->field($model, 'subtype1')->textInput() ?>

    <?= $form->field($model, 'subtype2')->textInput() ?>

    <?= $form->field($model, 'subtype3')->textInput() ?>

    <?= $form->field($model, 'vch1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vch2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Записать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
