<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;
use app\models\Category;

$this->title = $model->name;
?>
<div class="middle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'middle_id',
            'name',
            'description:ntext',
            'sys_id',
            'title',
            'keyword:ntext',
            'category_id',
        ],
    ]) ?>

</div>
