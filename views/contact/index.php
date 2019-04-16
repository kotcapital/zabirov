<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use budyaga\users\models\User;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';

?>
<div class="contact-index">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<div class = "col-lg-12">
			<div class = "col-lg-1">
        <?php echo Html::a('Добавить', ['#'], [
                        'class' => 'btn btn-success',
                        'data-target' => '#addcontact',
						'data-toggle' => 'modal',
						'title' => 'Добавить',
                    ]);
			echo '</div><div class = "col-lg-1">';

			echo Html::a('', ['/contact/download/'], [
                        'class' => 'glyphicon glyphicon-download',
                        'data-target' => '#downcontact',
						'data-toggle' => 'tooltip',
						'data-pjax' => '0',
						'title' => 'Скачать',
                    ]);
			echo '</div><div class = "col-lg-3">';
			$form = ActiveForm::begin([
				'action' =>['/contact/upload/'],
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
						'title' => 'Загрузить xsl поля ( contact_id:: name:: address:: phone:: email::)',
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
				'label' => 'contact_id',
				'attribute' => 'contact_id',
                'format' => 'raw',
                'value'=>function ($data){return $data['contact_id'];},
            ],
        
            [
				'label' => 'name',
				'attribute' => 'name',
                'format' => 'raw',
                'value'=>function ($data){return $data['name'];},
            ],
        
            [
				'label' => 'address',
				'attribute' => 'address',
                'format' => 'raw',
                'value'=>function ($data){return $data['address'];},
            ],
        
            [
				'label' => 'phone',
				'attribute' => 'phone',
                'format' => 'raw',
                'value'=>function ($data){return $data['phone'];},
            ],
        
            [
				'label' => 'email',
				'attribute' => 'email',
                'format' => 'raw',
                'value'=>function ($data){return $data['email'];},
            ],
        
            [
				'format' => 'raw',
				'value'=>function ($data){
					return Html::a(
                        '',
                        ['/contact/view', 'id' => $data['contact_id']],
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
                        ['/contact/update', 'id' => $data['contact_id']],
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
                        ['/contact/delete', 'id' => $data['contact_id']],
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



<div class="modal fade" id="addcontact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				'action' => ['/contact/create/'],
				'id' => 'add-contact'
			]); ?>
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

		<div class="form-group">
			<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
</div>
