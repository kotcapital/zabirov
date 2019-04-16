<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Filters */

$this->title = $model->name;
?>
<div class="filters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'filter_id',
            'name',
            'param',
            'category_id',
            'middle_id',
            'subcategory_id',
            'sort',
        ],
    ]) ?>

</div>
