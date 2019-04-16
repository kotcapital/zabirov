<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use budyaga\users\models\User;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Category;
use app\models\Middle;
use app\models\Subcategory;
use app\models\Filters;
use app\models\Catalog;

$this->title = 'Filters';

$param = Catalog::getMapParameters();
$category = Category::getTypeMap();
$middle = Middle::getTypeMap();
$type = Filters::getTypeArray();
?>
<div class="filters-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<div class = "col-lg-12">
			<div class = "col-lg-1">
        <?php echo Html::a('Добавить', ['#'], [
                        'class' => 'btn btn-success',
                        'data-target' => '#addfilters',
						'data-toggle' => 'modal',
						'title' => 'Добавить',
                    ]);
			?>
			</div>
		</div>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'summary' => false, 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
            [
				'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) { 
					return $data['name'];
				},
            ],
        
            [
				'attribute' => 'param',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['param'];
				},
            ],
        
            [
				'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function ($data) use ($category) {
					return ArrayHelper::getValue($category, $data['category_id']);
				},
            ],
			
			[
				'attribute' => 'type',
                'format' => 'raw',
                'value' => function ($data) use ($type) {
					return ArrayHelper::getValue($type, $data['type']);
				},
            ],
			
			[
				'attribute' => 'name2',
                'format' => 'raw',
                'value' => function ($data){
					return $data['name2'];
				},
            ],
        
            [
				'attribute' => 'sort',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['sort'];
				},
            ],
        
            [
				'format' => 'raw',
				'value'=>function ($data){
					return Html::a(
                        '',
                        ['/filters/view', 'id' => $data['filter_id']],
                        [
						    'class' => 'glyphicon glyphicon-eye-open',
							'data-toggle' => 'tooltip',
							'title' => 'Просмотр',
						]
                    );
				},
			],

            [
				'format' => 'raw',
				'value'=>function ($data){
					return Html::a(
                        '',
                        ['/filters/update', 'id' => $data['filter_id']],
                        [
						    'class' => 'glyphicon glyphicon-pencil',
							'data-toggle' => 'tooltip',
							'title' => 'Изменить',
						]
                    );
				},
			],

            [
				'format' => 'raw',
				'value'=>function ($data){
					return Html::a(
                        '',
                        ['/filters/delete', 'id' => $data['filter_id']],
                        [
						    'class' => 'glyphicon glyphicon-trash',
							'onclick'=>'return confirm("Вы уверены?");',
							'data-toggle' => 'tooltip',
							'title' => 'Удалить',
						]
                    );
				},
			],
        ],
    ]); ?>
    <?php Pjax::end(); ?>



<div class="modal fade" id="addfilters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавить</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $form = ActiveForm::begin([
				'action' => ['/filters/create/'],
				'id' => 'add-filters'
			]); ?>
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'type')->dropDownList($type, ['prompt' => 'Тип']) ?>
	
			<?= $form->field($model, 'name2')->textInput(['maxlength' => true]) ?>
	
			<?= $form->field($model, 'param')->dropDownList($param, ['prompt' => 'Параметры']) ?>

			<?= $form->field($model, 'category_id')->dropDownList($category, ['prompt' => 'Категория']) ?>

			<?= $form->field($model, 'middle_id')->dropDownList($middle, ['prompt' => 'Подкатегория']) ?>

			<?= $form->field($model, 'sort')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
</div>
