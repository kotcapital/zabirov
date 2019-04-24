<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\Manufacture;
use app\models\Middle;
use app\models\Subcategory;
use app\models\Catalog;

$category = Category::getTypeMap();
$manufacture = Manufacture::getTypeMap();
$middle = Middle::getTypeMap();


?>

<section class="header_line">
	<div class="container">
		<h2>Магазин</h2>
	</div>
</section>

<section id="services" class="ajaxLoadServices ajaxservices">
	<div class="container flex">
		<!-- BEGIN SIDEBAR -->
	<?php echo Yii::$app->runAction('/catalog/renderfilter') ?>

	<!-- END SIDEBAR -->
		<main>
			<div id="container_1" class="row" style="margin-left:0px">
				<?php
					$label = '<span><strong>Заказать</strong></span>';
					if (count($catalog) == 0){
						if (Yii::$app->request->get('category_id') != 1) {
							$label2 = '<span><strong>Отправить запрос</strong></span>';
							echo Html::a($label2, '#x', [
								'class' => 'btn flex aic jcc order',  
								'onclick' => 'popup(1, this)',
								'comment' => 'Запрос',
								'category' => ArrayHelper::getValue($category, Yii::$app->request->get('category_id')),
								'manufacture' => ArrayHelper::getValue($manufacture, Yii::$app->request->get('manufacture_id')),
								]);
						}else{
							echo '<a class="btn flex aic jcc" data-toggle="modal" data-target="#opros_list"><span><strong>Отправить запрос</strong></span></a>';
						}
					}else{
						$cnt = 1;
						foreach ($catalog as $goods) {
							if (isset($goods['price'])) {
								$res = '';
								$catalog = new Catalog();
								$catalog->setAttributes($goods);
								$image = $catalog->getImagePath($middle_img, $category_img);
								if (file_exists($image)) {
									$res .= '<div class="img"><img src="/' . $image . '" ></div>';
								}
								
								if ($goods['price'] == '0.00') {
									$goods['price'] = 'Цену уточняйте';
								}else{
									$goods['price'] = $goods['price'] . '₽';
								}
								
								$res .= '
										<div class="text">
											<p class="service_name">' . $goods['name'] . '</p>
											<p class="service_price">' . $goods['price'] . '</p>
										</div>
										';
								$alias = $goods['name'];
								
								echo 
									'
										<div class="product_card col-xs-6 col-md-3" style="padding-left:0px;padding-right:0px;height:auto">
											<div class="image" style="height:85%;margin-bottom:5%">
												' . Html::a($res, ['/site/single/' . $goods['goods_id'] . '/' . Catalog::getAlias($alias) . ''], ['id' => $goods['goods_id']]) . '
											</div>
											<div class="order" style="height:10%">
												' . Html::a($label, '#x', [
														'class' => 'btn flex aic jcc order',
														'onclick' => 'popup(1, this)',
														'comment' => 'Заказ товара',
														'id' => $goods['goods_id'],
														'name' => $goods['name'],
														'category' => ArrayHelper::getValue($category, $goods['category_id']),
														'middle' => ArrayHelper::getValue($middle, $goods['middle_id']),
														'manufacture' => ArrayHelper::getValue($manufacture, $goods['manufacture_id'])
													]). '
											</div>
										</div>
										';
								
								$cnt++;
							}else{
								$category_card =  '
										<div class="col-md-12 col-xs-12 category">
											<div class="img"><img style="height:70px" src="/img/category/' . $goods['category_id'] . '.' . $goods['img'] . '" alt=""></div>
											<p style="font-size:12px">' . $goods['name'] . '</p>
										</div>
									';
								echo Html::a($category_card,['/site/services', 'category_id' => $goods['category_id'], 'manufacture_id' => Yii::$app->request->get('manufacture_id')], ['class' => 'col-md-3 col-xs-6', 'style' => 'margin-bottom:20px']);
							}
						}
						
					}
					
				?>
			</div>
		</main>
	</div>
</section>

<?php echo Yii::$app->runAction('/site/renderseparator') ?>

