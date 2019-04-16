<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Tarifs */

$this->title = $model->name;
?>
<div class="tarifs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tarif_id',
            'name',
            'amount',
            'price',
        ],
    ]) ?>

</div>
