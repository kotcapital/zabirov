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

$name_product = Yii::$app->request->post('search');
$category_name = ArrayHelper::getValue($category, Yii::$app->request->post('category_id')); 
$middle_name = ArrayHelper::getValue($middle, Yii::$app->request->post('middle_id')); 
$manufacture_name = ArrayHelper::getValue($manufacture, Yii::$app->request->post('manufacture_id')); 
$price = 'от: ' . Yii::$app->request->post('price_from') . ' до: ' . Yii::$app->request->post('price_to');

?>
<div id="container_1" class="row" style="margin-left:0px">
	<?php
		$label = '<span><strong>Заказать</strong></span>';
		if (count($catalog) == 0){
			if (Yii::$app->request->post('category_id') != 1) { 
				echo 
					'
						<div class="content col-xs-6 col-xs-offset-3">
							<p class="text text-center">Заполните форму и мы подберём для вас лучшее предложение в ближайшее время</p>
							<form action="/site/formsubmit" method="post">
								<input type="text" name="name" placeholder="Имя">
								<input type="text" name="tel" placeholder="Телефон или почта" required="">
								<div id="orderForm">
									<input type="hidden" value="' . $name_product . '" name="tovar">
									<input type="hidden" value="' . $category_name . '" name="category">
									<input type="hidden" value="' . $middle_name . '" name="middle">
									<input type="hidden" value="' . $manufacture_name . '" name="manufacture">
									<input type="hidden" value="' . $price . '" name="price">
									<input type="hidden" value="Заказ товара" name="comment">
								</div>
								<input type="submit" value="Отправить">
								<p class="policy">Нажимая на кнопку "Отправить" <br> Вы подтверждаете свое согласие на <br> обработку Ваших персональных данных</p>
							</form>
						</div>
					';
			}else{
				echo 
					'
						<div class="questionnaire col-xs-12">
							<h4 class="text text-center">Введите данные для расчета</br> и мы с вами свяжемся в ближайшее время</h4>
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