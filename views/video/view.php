<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = $model->title;
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'video_id',
            'title',
            'link',
        ],
    ]) ?>

</div>
