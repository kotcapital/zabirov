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

$this->title = 'Middles';

?>
<div class="middle-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<div class = "col-lg-12">
			<div class = "col-lg-1">
        <?php echo Html::a('Добавить', ['#'], [
				'class' => 'btn btn-success',
				'data-target' => '#addmiddle',
				'data-toggle' => 'modal',
				'title' => 'Добавить',
			]);
		?>
			</div>
		</div>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
			[
				'attribute' => 'ID',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['middle_id'];
				},
            ],

            [
				'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['name'];
				},
            ],
        
            [
				'attribute' => 'description',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['description'];
				},
            ],
        
            [
				'attribute' => 'sys_id',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['sys_id'];
				},
            ],
        
            [
				'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['title'];
				},
            ],
        
            [
				'attribute' => 'keyword',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['keyword'];
				},
            ],
        
            [
				'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function ($data) {
					return Category::getTypeMap()[$data->category_id];
				},
            ],
			
			[
				'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($data) use ($upload) {
					$res = '';
					if ($data['img'] != null) {
						$res .= '<img src="/img/middle/' . $data['middle_id'] . '.' . $data['img']. '">';
					}
					$res .= Html::beginForm(
						['/middle/uploadimg/'],
						'post',
						['enctype' => 'multipart/form-data','class' => 'form-inline']
					);
					$res .= Html::fileInput('Upload[file]', null);
					$res .= Html::hiddenInput('middle_id', $data['middle_id']);
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
                        ['/middle/view', 'id' => $data['middle_id']],
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
                        ['/middle/update', 'id' => $data['middle_id']],
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
                        ['/middle/delete', 'id' => $data['middle_id']],
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



<div class="modal fade" id="addmiddle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				'action' => ['/middle/create/'],
				'id' => 'add-middle'
			]); ?>
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'sys_id')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'category_id')->dropDownList(Category::getTypeMap(['category_id', 'name'])) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keyword')->textarea(['rows' => 4]) ?>

		<div class="form-group">
			<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
</div>
