<?php

use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Faq */
?>
<div class="faq-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
