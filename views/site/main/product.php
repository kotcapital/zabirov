<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Catalog;
use app\models\Category;
use app\models\Manufacture;
use app\models\Middle;

$manufacture = Manufacture::getTypeMap();
$category = Category::getTypeMap();
$middle = Middle::getTypeMap();
$post = Yii::$app->request->post();

?>
<div id="container_1" class="row" style="margin-left:0px">
	<?php
		$label = '<span><strong>Заказать</strong></span>';
		if (count($catalog) == 0){
			if (Yii::$app->request->post('category_id') != 1) { 
				$label = '<span><strong>Отправить запрос</strong></span>';
				$price = 'от : '. $post['price_from'] . 'до : ' . $post['price_to'];
				$param = '';
				if (isset($post['i1'])) {
					$param .= ' i1 : ' . $post['i1'];
				}
				if (isset($post['i2'])) {
					$param .= ' i2 : ' . $post['i2'];
				}
				if (isset($post['i3'])){
					$param .= ' i3 : ' . $post['i3'];
				}
				$middle_id = '';
				if (isset($post['middle_id'])){
					$middle_id = $post['middle_id'];
				}

				echo Html::a($label, '#x', [
					'class' => 'btn flex aic jcc order',  
					'onclick' => 'popup(1, this)',
					'comment' => 'Запрос',
					'category' => ArrayHelper::getValue($category, $post['category_id']),
					'middle' => ArrayHelper::getValue($middle, $middle_id),
					'price' => $price,
					'name' => $post['search'],
					'param' => $param,
					]);
			}else{
				echo '<a class="btn flex aic jcc" data-toggle="modal" data-target="#opros_list"><span><strong>Отправить запрос</strong></span></a>';
			}
		} else {
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
										'id' => $goods['goods_id'],
										'name' => $goods['name'],
										'manufacture' => ArrayHelper::getValue($manufacture, $goods['manufacture_id']),
										'category' => ArrayHelper::getValue($category, $goods['category_id']),
										'middle' => ArrayHelper::getValue($middle, $goods['middle_id']),
										'comment' => 'Заказ товара'
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
					echo Html::a($category_card,['/site/services', 'category_id' => $goods['category_id'], 'manufacture_id' => Yii::$app->request->post('manufacture_id')], ['class' => 'col-md-3 col-xs-6', 'style' => 'margin-bottom:20px']);
					$cnt++;
				}
			
			}
		}
	?>
</div>