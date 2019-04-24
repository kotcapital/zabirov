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

$this->title = 'Categories';
$type = Category::getTypeArray(); 
?>
<div class="category-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<div class = "col-lg-12">
			<div class = "col-lg-1">
				<?php echo Html::a('Добавить', ['#'], [
						'class' => 'btn btn-success',
						'data-target' => '#addcategory',
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
					return $data['category_id'];
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
				'attribute' => 'type',
                'format' => 'raw',
                'value' => function ($data) use ($type) {
					return ArrayHelper::getValue($type, $data['type']);
				},
            ],
			
			[
				'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($data) use ($upload) {
					$res = '';
					if ($data['img'] != null) {
						$res .= '<img class="img-responsive" src="/img/category/' . $data['category_id'] . '.' . $data['img']. '">';
					}
					$res .= Html::beginForm(
						['/category/uploadimg/'],
						'post',
						['enctype' => 'multipart/form-data','class' => 'form-inline']
					);
					$res .= Html::fileInput('Upload[file]', null);
					$res .= Html::hiddenInput('category_id', $data['category_id']);
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
                        ['/category/view', 'id' => $data['category_id']],
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
                        ['/category/update', 'id' => $data['category_id']],
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
                        ['/category/delete', 'id' => $data['category_id']],
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



<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				'action' => ['/category/create/'],
				'id' => 'add-category'
			]); ?>
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'sys_id')->textInput(['maxlength' => true]) ?>

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
