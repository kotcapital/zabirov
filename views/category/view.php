<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'category_id',
            'name',
            'description:ntext',
            'sys_id',
            'title',
            'keyword:ntext',
        ],
    ]) ?>

</div>
