<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;
use app\models\Catalog;
use app\models\Category;
use app\models\Middle;
use app\models\Manufacture;
use yii\helpers\ArrayHelper;

$this->title = $model->name;
?>
<div class="catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'goods_id',
            'name',
            'description:ntext',
            'price',
            'sys_id',
            'title',
            'keyword:ntext',
			[                     
				'label' => 'Тип',
				'value' => ArrayHelper::getValue(Catalog::getTypeArray(), $model->type) . '(' . $model->type . ')',
			],
			[                     
				'label' => 'Категория',
				'value' => ArrayHelper::getValue(Category::getTypeMap(), $model->category_id) . '(' . $model->category_id . ')',
			],
			[                     
				'label' => 'Подкатегории',
				'value' => ArrayHelper::getValue(Middle::getTypeMap(), $model->middle_id) . '(' . $model->middle_id . ')',
			],
			[                     
				'label' => 'Производитель',
				'value' => ArrayHelper::getValue(Manufacture::getTypeMap(), $model->manufacture_id) . '(' . $model->manufacture_id . ')',
			],
			[                     
				'label' => 'Статус',
				'value' => Catalog::getStatusById($model->status_id),
			],
            'i1',
            'i2',
            'vch1',
            'vch2',
            'vch3',
            'vch4',
        ],
    ]) ?>

</div>
