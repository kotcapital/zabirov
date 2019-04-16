<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use budyaga\users\models\User;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Cases';

?>
<div class="cases-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<div class = "col-lg-12">
			<div class = "col-lg-1">
				<?php echo Html::a('Добавить', ['#'], [
						'class' => 'btn btn-success',
						'data-target' => '#addcases',
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
				'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['title'];
				},
            ],
        
            [
				'attribute' => 'before',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['before'];
				},
            ],
        
            [
				'attribute' => 'after',
                'format' => 'raw',
                'value' => function ($data) {
					return $data['after'];
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
				'attribute' => 'difference',
                'format' => 'raw',
                'value'=> function ($data) {
					return $data['difference'];
				},
            ],
			
			[
				'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($data) use ($upload) {
					$res = '';
					$res .= '<img src="/img/cases/' . $data['cases_id'] . '.' . $data['img']. '">';
					$res .= Html::beginForm(
						['/cases/uploadimg/'],
						'post',
						['enctype' => 'multipart/form-data','class' => 'form-inline']
					);
					$res .= Html::fileInput('Upload[file]', null);
					$res .= Html::hiddenInput('cases_id', $data['cases_id']);
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
					$res =  Html::a(
						'',
						['/cases/view', 'id' => $data['cases_id']],
						[
							'class' => 'glyphicon glyphicon-eye-open',
							'data-toggle' => 'tooltip',
							'title' => 'Просмотр',
						]
					);
					return (Yii::$app->user->can('settings') ? $res : '');
				},
			],

            [
				'format' => 'raw',
				'value'=>function ($data){
					return Html::a(
                        '',
                        ['/cases/update', 'id' => $data['cases_id']],
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
                        ['/cases/delete', 'id' => $data['cases_id']],
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



<div class="modal fade" id="addcases" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				'action' => ['/cases/create/'],
				'id' => 'add-cases'
			]); ?>
		    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'before')->textInput() ?>

    <?= $form->field($model, 'after')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'difference')->textInput(['maxlength' => true]) ?>

		<div class="form-group">
			<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
</div>
