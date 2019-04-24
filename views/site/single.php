<?php
use app\models\Catalog;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\Manufacture;
use app\models\Filters;
use app\models\Middle;

$this->title = Html::encode($goods['title']);
	
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => Html::encode($goods['keyword']),
]);	

$goods_id = Yii::$app->request->get('id');
$manufacture_id = Yii::$app->request->get('manufacture_id');
$characteristic = Filters::find()->where(['category_id' => $goods['category_id']])->asArray()->all();

$category = Category::getTypeMap();
$manufacture = Manufacture::getTypeMap();
$middle = Middle::getTypeMap();
?>
<section class="header_line">
	<div class="container">
		<h2>Магазин</h2>
	</div>
</section>

<section id="services" class="singlePge ajaxLoadServices ajaxservices">
	<div class="container flex">
		<!-- BEGIN SIDEBAR -->
		<?php echo Yii::$app->runAction('/catalog/renderfilter') ?>
		<!-- END SIDEBAR -->
		<main>
			<div class="header col-md-12">
				<?php
					$catalog = new Catalog();
					$catalog->setAttributes($goods);
					$image = $catalog->getImagePath($middle_img, $category_img);
					if (file_exists($image)) {
						echo '<div class="img col-md-12"><img class="img-responsive" src="/' . $image . '" alt="' . $goods['catname'] . '.' . $goods['name'] . '"></div>';
					}
				?>
				<div class="text">
					<?php
					if ($goods['price'] == '0.00') {
						$goods['price'] = 'Цену уточняйте';
					}else{
						$goods['price'] = $goods['price'] . '₽';
					}
					?>
					<p class="service_name "><?= $goods['name'] ?></p>
					<p class="service_price text text-center"><?= $goods['price'] ?></p>
				</div>
			</div>
			<?php
					$label = '<span><strong>Заказать</strong></span>';
					echo Html::a($label, '#x', [
						'class' => 'btn flex aic jcc order',
						'onclick' => 'popup(1, this)',
						'id' => $goods['goods_id'],
						'name' => $goods['name'],
						'manufacture' => ArrayHelper::getValue($manufacture, $goods['manufacture_id']),
						'category' => ArrayHelper::getValue($category, $goods['category_id']),
						'middle' => ArrayHelper::getValue($middle, $goods['middle_id']),
						'comment' => 'Заказ товара'
					]);
			?>
			<?php
				if ($goods['category_id'] == 9) {
					echo '<a class="btn flex aic jcc" style="margin-top:15px" data-toggle="modal" data-target="#list_of_questionnaires"><span><strong>Опросный лист</strong></span></a>';
				}
			?>
			<!-- header-->
			<div class="body">
				<ul class="sercive_tabs">
					<?php 
						if ($goods['description'] != null) {
							echo '<li class="active">Описание</li>';
						}else{
							echo '';
						}
				
						if ($characteristic != null) {
							echo '<li>Характеристики</li>';
						}else{
							echo '';
						}
					
						if ($goods['img'] != null) {
							echo '<li>Фото</li>';
						}else{
							echo '';
						}
					
						if ($goods['category_id'] == 1) {
							echo '<li>Опросный лист</li>';
						}else{
							echo '';
						}
					?>
				</ul>
				<!-- sercive_tabs -->
				<div class="content_block">
					<div class="switch_block active">
						<p><?= $goods['description'] ?></p>
					</div>
					<?php 
						if ($characteristic != null) {
							echo '<div class="switch_block">';
						}
					?>
						<p><?php
								foreach ($characteristic as $char) {
									if ($char['name2'] != null) {
										if ($goods[$char['param']] != null) {
											echo $char['name2'] . ': ' . $goods[$char['param']] . '</br>';
										}
									}
								}
							?>
						</p>
					<?php 
						if ($characteristic != null) {
							echo '</div>';
						}
					?>
					<?php 
						if ($goods['img'] != null) {
							echo '<div class="switch_block">';
								echo '<div class="img col-md-12"><img class="img-responsive" src="/' . $image . '" alt="' . $goods['catname'] . '.' . $goods['name'] . '"></div>';
							echo '</div>';
						}
					?>
					<?php
						if ($goods['category_id'] == 1) {
							echo '
								<div class="switch_block">
									<h4 class="text text-center">Введите данные для расчета</h4>
									<form action="/site/formsubmit" method="post" style="width:auto;padding-left:0px;padding-right:0px">
										<div class="row">
											<div class="col-xs-12">
												<input style="margin-top:0px" class="form-control" placeholder="Мощность(тепловая нагрузка)" name="power">
											</div>
											<div class="col-xs-12">
												<div class="col-xs-12 col-md-4" style="padding-left:0px;padding-right:0px">
													<div class="col-xs-12" style="margin-bottom:10px;margin-top:5px;padding-left:0px;padding-right:0px">
														<input class="form-control" placeholder="t°C греющей среды(вход.)" name="temperature_of_the_heating_medium(in)">
													</div>
													<div class="col-xs-12" style="margin-bottom:15px;margin-top:10px;padding-left:0px;padding-right:0px">
														<input class="form-control" placeholder="t°C греющей среды(выход.)" name="temperature_of_the_heating_medium(out)">
													</div>
													<div class="col-xs-12" style="margin-bottom:15px;padding-left:0px;padding-right:0px">
														<input class="form-control" placeholder="Тип греющей среды" name="type_of_the_heating_medium">
													</div>
													<div class="col-xs-12" style="margin-bottom:15px;padding-left:0px;padding-right:0px">
														<p>Допускаем потери напора в ПТО для греющей среды, макс.</p>
														<input style="margin-top:0px" class="form-control" name="allowable_head_loss_for_heating">
													</div>
												</div>
												<div class="col-md-4 image_questionnaire hidden-xs">
													<div class="col-xs-12">
														<img src="/img/gotova.png" class="img-responsive" style="margin: 0 auto" a/>
													</div>
												</div>
												<div class="col-xs-12 col-md-4" style="padding-left:0px;padding-right:0px">
													<div class="col-xs-12" style="margin-bottom:10px;margin-top:5px;padding-left:0px;padding-right:0px">
														<input class="form-control" placeholder="t°C нагретой среды(выход.)" name="temperature_of_the_heated_medium(out)">
													</div>
													<div class="col-xs-12" style="margin-bottom:15px;margin-top:10px;padding-left:0px;padding-right:0px">
														<input class="form-control" placeholder="t°C нагретой среды(вход.)" name="temperature_of_the_heated_medium(in)">
													</div>
													<div class="col-xs-12" style="margin-bottom:15px;padding-left:0px;padding-right:0px">
														<input class="form-control" placeholder="Тип нагретой среды" name="type_of_heated_medium">
													</div>
													<div class="col-xs-12" style="margin-bottom:15px;padding-left:0px;padding-right:0px">
														<p>Допускаем потери напора в ПТО для нагрев.среды, макс.</p>
														<input style="margin-top:0px" class="form-control" name="allowable_head_loss_for_heated">
													</div>
												</div>
											</div>
											<div class="col-xs-12">
												<p style="font-size:16px;margin-bottom:5px" class="text text-center">Дополнительные сведения и требования</p>
												<textarea class="form-control" rows="2" name="additional_information"></textarea>
											</div>
											<div class="col-xs-12">
												<div class="col-xs-6">
													<input type="text" class="hidden" name="name" placeholder="Имя">
												</div>
												<div class="col-xs-6">
													<input type="text" class="hidden" name="tel" placeholder="Телефон или почта" required="">
												</div>
											</div>
											<div class="col-xs-12">
												<div class="col-xs-6">
													<input type="text" name="name" placeholder="Имя">
												</div>
												<div class="col-xs-6">
													<input type="text" name="tel" placeholder="Телефон или почта" required="">
												</div>
											</div>
										</div>
										<input type="hidden" name="comment" value="Опросный лист">
										<button type="submit" class="btn-submit center-block" style="margin-top:15px">Отправить</button>
									</form>
								</div>
							';
						}else{
							echo '';
						}
						?>
						
					
				</div>	
			</div>
		</main>
	</div>
</section>

<?php echo Yii::$app->runAction('/site/renderseparator') ?>
