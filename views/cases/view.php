<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Cases */

$this->title = $model->title;
?>
<div class="cases-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cases_id',
            'title',
            'img',
            'before',
            'after',
            'description:ntext',
            'difference',
        ],
    ]) ?>

</div>
