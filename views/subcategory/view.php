<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategory */

$this->title = $model->name;
?>
<div class="subcategory-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subcategory_id',
            'name',
            'description:ntext',
            'sys_id',
            'title',
            'keyword:ntext',
            'category_id',
            'middle_id',
        ],
    ]) ?>

</div>
