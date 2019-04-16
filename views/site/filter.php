<?php
use yii\helpers\Html;
use app\models\Catalog;
use app\models\Category;
use app\models\Middle;
use app\models\Manufacture;
use app\models\Filters;

$manufacture = Manufacture::getTypeMap(); 
$goods_id = Yii::$app->request->get('id');
$good = Catalog::findOne($goods_id);
$filters = Filters::find()->where(['category_id' => $good['category_id']])->andWhere(['not', ['type' => null]])->asArray()->all();
$category = Category::getTypeMap();
$middle = Middle::getTypeMap();
?>

<a class="filters btn"><span><strong>Фильтры</strong></span></a>
	<!-- breadcrumbs -->
	<div class="sidebar	hidden-sm">
		<div class="close">&times;</div>
		<p class="price">
			<?php
				foreach ($filters as $fil) {
					if ($fil['type'] == '30') {
						echo $fil['name'];
					}
				}
			?>
		</p>
		<form class="filterForm" method="post">
			<?php  
				foreach ($filters as $fil) {
					if ($fil['type'] == '30') {
						echo 
							'
								<div class="slider">
									<div class="inputs flex jcsb" id="priceslider" maxval="12000">
										<div class="form_control before price_controls">
											<input id="price_from" type="text" class="sliderValue ajaxsearch" data-index="0" value="0" />
										</div>
										<div class="form_control after price_controls">
											<input id="price_to" type="text" class="sliderValue ajaxsearch" data-index="1" value="12000" />
										</div>
									</div>
									<!-- inputs -->
									<div id="slider">
										<span class="coloredLine first ajaxsearch"></span>
										<span class="coloredLine last ajaxsearch"></span>
									</div>
								</div>
								<!-- slider -->
							';
					}
				}
			?>
			<?php
				foreach ($filters as $fil) {
					if ($fil['type'] == '40') {
						echo 
							'
								<div class="checkboxes">
									' . Html::dropDownList('category_id', null, $category,  ['prompt' => 'Выберите категорию', 'class' => 'form-control ajaxsearch', 'id' => 'category']) . '
									
								</div>
							';
					}
				}
			?>
			<div id="subcategory" class="checkboxes">
			
			</div>
			<div id="param">
				
			</div>
			<?php
				foreach ($filters as $fil) {
					if ($fil['type'] == '10') {
						echo '<div class="dropdown_checkboxes checkboxes">';
						foreach ($manufacture as $key => $value) {
							echo 
							'
								<div class="form_control ajaxsearch">
									<input type="checkbox" name="' . $value . '" id="manufacture' . $key . '" value="' . $key . '">
									<label for="manufacture' . $key . '">' . $value . '</label>
								</div>
							';
						}
						echo '</div>';
					}
				}
			?>
			<!-- checkboxes -->
			<div class="search">
				<input type="search" placeholder = "Название" name="search" class="ajaxsearch" id="search">
			</div>
		</form>
	</div>
	
	
	
	