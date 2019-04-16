<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title = $model->name;
?>
<div class="contact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'contact_id',
            'name',
            'address',
            'phone',
            'email:email',
        ],
    ]) ?>

</div>
