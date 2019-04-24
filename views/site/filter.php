<?php
use yii\helpers\Html;
use app\models\Catalog;
use app\models\Category;
use app\models\Middle;
use app\models\Manufacture;
use app\models\Filters;

 
$goods_id = Yii::$app->request->get('id');
$good = Catalog::findOne($goods_id);
$filters = Filters::find()->where(['category_id' => $good['category_id']])->andWhere(['not', ['type' => null]])->asArray()->all();
$category = Category::getTypeMap();

?>

<a class="filters btn" style="margin-bottom:10px"><span><strong>Фильтры</strong></span></a>
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
									' . Html::dropDownList('category_id', Yii::$app->request->get('category_id'), $category,  ['prompt' => 'Выберите категорию', 'class' => 'form-control ajaxsearch', 'id' => 'category']) . '
									
								</div>
							';
					}
				}
			?>
			<div id="subcategory" class="checkboxes">
				<?php
					if (Yii::$app->request->get('category_id') != null) {
						$category_id = Yii::$app->request->get('category_id');
						$middle = Middle::getMapForCategory($category_id);
						if (count($middle) != 0) {
							echo Html::dropDownList('middle_id', null, $middle, ['prompt' => 'Выберите подкатегорию', 'class' => 'form-control ajaxsearch', 'id' => 'middle_id']);
						}
						
					}
				?>
			</div>
			<div id="param">
				
			</div>
			<?php
				$cnt = 0;
				$manufact_key_from_get = 0;
				foreach ($filters as $fil) {
					if ($fil['type'] == '10') {
						echo '<div class="dropdown_checkboxes checkboxes">';
						$manufact = Yii::$app->request->get('manufacture_id');
						foreach ($manufacture as $key => $value) {
							echo '<div class="form_control ajaxsearch col-xs-6 col-md-12" style="margin-bottom:0px;margin-top:5px">';
							if ($manufact != null) {
								if (is_array($manufact)) {
									foreach ($manufact as $m) {
										if ($m == $key) {
											echo 
												'
													<input type="checkbox" name="' . $value. '" id="manufacture' . $key . '" value="' . $key . '" checked="checked">
													<label for="manufacture' . $key . '">' . $value . '</label>
												';
											$manufact_key_from_get = $m;
										}
									}
									if ($key != $manufact_key_from_get) {
										echo 
											'
												<input type="checkbox" name="' . $value. '" id="manufacture' . $key . '" value="' . $key . '">
												<label for="manufacture' . $key . '">' . $value . '</label>
											';
									}
								}else{
									if ($manufact == $key) {
										echo 
											'
												<input type="checkbox" name="' . $value. '" id="manufacture' . $key . '" value="' . $key . '" checked="checked">
												<label for="manufacture' . $key . '">' . $value . '</label>
											';
									}else{
										echo 
											'
												<input type="checkbox" name="' . $value. '" id="manufacture' . $key . '" value="' . $key . '">
												<label for="manufacture' . $key . '">' . $value . '</label>
											';
									}
								}
							}else{
								echo 
									'
										<input type="checkbox" name="' . $value . '" id="manufacture' . $key . '" value="' . $key . '">
										<label for="manufacture' . $key . '">' . $value . '</label>
									';
							}
							echo '</div>';
							$cnt++;
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
	
	
	
	