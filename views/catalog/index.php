<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use budyaga\users\models\User;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Catalog;
use app\models\Category;
use app\models\Middle;
use app\models\Manufacture;

$this->title = 'Catalogs';

$categories = Category::getTypeMap();
$manufacture = Manufacture::getTypeMap();
$status = Catalog::getStatusArray();
$type = Catalog::getTypeArray();
$middle = Middle::getTypeMap();

?>
<div class="catalog-index">
    <?php Pjax::begin(); ?>

    <p>
		<div class = "col-lg-12">
			<div class = "col-lg-1">
        <?php echo Html::a('Добавить', ['#'], [
                        'class' => 'btn btn-success',
                        'data-target' => '#addcatalog',
						'data-toggle' => 'modal',
						'title' => 'Добавить',
                    ]);
			echo '</div><div class = "col-lg-1">';

			echo Html::a('', ['/catalog/download/'], [
                        'class' => 'glyphicon glyphicon-download',
                        'data-target' => '#downcatalog',
						'data-toggle' => 'tooltip',
						'data-pjax' => '0',
						'title' => 'Скачать',
                    ]);
			echo '</div><div class = "col-lg-3">';
			$form = ActiveForm::begin([
				'action' =>['/catalog/upload/'],
				'options' => ['enctype' => 'multipart/form-data','class' => 'form-inline']
			]);
			echo FileInput::widget([
				'model' => $upload,
				'attribute' => 'file',
				'options' => ['multiple' => false],
				'pluginOptions' => [
					'showPreview' => false,
					'showCaption' => true,
					'showRemove' => true,
					'showUpload' => false
				]
			]);
			echo '</div><div class = "col-lg-1">';
			echo Html::submitButton(
					'Загрузить',
					[
						'class' => 'btn btn-success glyphicon glyphicon-upload',
						'name' => 'add-button',
						'data-toggle' => 'tooltip',
						'title' => 'Загрузить xsl поля ( goods_id:: name:: description:: price:: sys_id:: title:: keyword:: category_id:: middle_id:: subcategory_id:: manufacture_id:: status_id:: i1:: i2:: i3:: d1:: d2:: d3:: subtype1:: subtype2:: subtype3:: vch1:: vch2::)',
					]
				);
			ActiveForm::end(); ?>
			</div>
		</div>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
				'attribute' => 'price',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['price'];
				},
            ],
			
			[
				'attribute' => 'type',
                'format' => 'raw',
                'value' => function ($data) use ($type) {
					return ArrayHelper::getValue($type, $data->type);

				},
            ],
        
            [
				'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function ($data) use ($categories) {
					return ArrayHelper::getValue($categories, $data->category_id);
				},
            ],
        
            [
				'attribute' => 'middle_id',
                'format' => 'raw',
                'value' => function ($data) use ($middle) {
					return ArrayHelper::getValue($middle, $data->middle_id);
				},
            ],
        
            [
				'attribute' => 'manufacture_id',
                'format' => 'raw',
                'value' => function ($data) use ($manufacture) {
					return ArrayHelper::getValue($manufacture, $data->manufacture_id);
				},
            ],
        
            [
				'attribute' => 'status_id',
                'format' => 'raw',
                'value' => function ($data) use ($status) {
					return ArrayHelper::getValue($status, $data->status_id);
				},
            ],
			
			[
				'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($data) use ($upload) {
					$res = '';
					if ($data['img'] != null) {
						$res .= '<img class="img-responsive" src="/img/catalog/' . $data['goods_id'] . '.' . $data['img']. '">';
					}
					
					$res .= Html::beginForm(
						['/catalog/uploadimg/'],
						'post',
						['enctype' => 'multipart/form-data','class' => 'form-inline']
					);
					$res .= Html::fileInput('Upload[file]', null);
					$res .= Html::hiddenInput('goods_id', $data['goods_id']);
					$res .= Html::submitButton(
						'',
						[
							'class' => 'btn btn-success btn-xs glyphicon glyphicon-upload',
							'name' => 'add-button',
							'data-toggle' => 'tooltip',
						]
					);
					$res .= Html::endForm();
					return $res;
				},
			],
        
            [
				'format' => 'raw',
				'value'=>function ($data){
					return Html::a(
                        '',
                        ['/catalog/view', 'id' => $data['goods_id']],
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
                        ['/catalog/update', 'id' => $data['goods_id']],
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
                        ['/catalog/delete', 'id' => $data['goods_id']],
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



<div class="modal fade" id="addcatalog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				'action' => ['/catalog/create/'],
				'id' => 'add-catalog'
			]); ?>
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			
			<?= $form->field($model, 'type')->dropDownList($type) ?>
			
			<?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

			<?= $form->field($model, 'price')->textInput() ?>

			<?= $form->field($model, 'sys_id')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'keyword')->textarea(['rows' => 4]) ?>

			<?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Выберите категорию']) ?>

			<?= $form->field($model, 'middle_id')->dropDownList($middle, ['prompt' => 'Выберите подкатегорию']) ?>

			<?= $form->field($model, 'manufacture_id')->dropDownList($manufacture, ['prompt' => 'Выберите производителя']) ?>

			<?= $form->field($model, 'status_id')->dropDownList($status, ['prompt' => 'Выберите статус']) ?>

			<?= $form->field($model, 'i1')->textInput() ?>

			<?= $form->field($model, 'i2')->textInput() ?>

			<?= $form->field($model, 'i3')->textInput() ?>

			<?= $form->field($model, 'd1')->textInput() ?>

			<?= $form->field($model, 'd2')->textInput() ?>

			<?= $form->field($model, 'd3')->textInput() ?>

			<?= $form->field($model, 'subtype1')->textInput() ?>

			<?= $form->field($model, 'subtype2')->textInput() ?>

			<?= $form->field($model, 'subtype3')->textInput() ?>

			<?= $form->field($model, 'vch1')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'vch2')->textInput(['maxlength' => true]) ?>
	
		<div class="form-group">
			<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
</div>
