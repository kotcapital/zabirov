<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Faq */

$this->title = $model->faq_id;
?>
<div class="faq-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'faq_id',
            'question',
            'answer:ntext',
        ],
    ]) ?>

</div>
