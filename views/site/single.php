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
					$image = $catalog->getImagePath($middle, $category_img);
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
				
						<div class="switch_block">
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
						</div>
				
					<div class="switch_block">
						<?php
							if (file_exists($image)) {
								echo '<div class="img col-md-12"><img class="img-responsive" src="/' . $image . '" alt="' . $goods['catname'] . '.' . $goods['name'] . '"></div>';
							}
						?>
						
					</div>
					<?php 
						echo 
							'
								<div class="switch_block">
									<p>' . $goods['name'] . '</p>
								</div>
							';
					?>
				</div>	
			</div>
		</main>
	</div>
</section>

<?php echo Yii::$app->runAction('/site/renderseparator') ?>
