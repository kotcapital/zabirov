<?php

use yii\helpers\Html;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Middle */

$this->title = 'Create Middle';
$this->params['breadcrumbs'][] = ['label' => 'Middles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="middle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
