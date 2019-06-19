<?php
	use yii\helpers\Html;
	use app\models\Manufacture;

?>
	<?php echo Yii::$app->runAction('/site/renderhomepage') ?>
	
	<section id="s02">
		<div class="container">
			<h2 class="gradient"><span>Наши услуги</span></h2>
			<div class="row services tac">
				<div class="row">
				<?php
					$cnt = 1;
					foreach ($category as $cat) {
						$res =  '
								<div class="col-md-3 col-sm-3 col-xs-6 category" style="margin-bottom:20px">
									<div class="img"><img src="/img/category/' . $cat['category_id'] . '.' . $cat['img'] . '" alt=""></div>
									<p>' . $cat['name'] . '</p>
								</div>
							';
						echo Html::a($res,['/site/services', 'category_id' => $cat['category_id']]);
						
						if ($cnt % 4 == 0){
							if ($cnt) {
								echo '</div>';
								echo '<div class="row">';
							}
						}
						
						$cnt++;
					};
					
				?>
				</div>
			</div>
			
			<!-- /.row services -->
			<h2 class="gradient complect" style="margin-bottom:40px"><span>оборудование и комлектующие</span></h2>
			<div class="row complect tac">
				<?php
					foreach ($manufacture as $manu) {
						$res =  '
								<div class="col-md-2 col-sm-4 col-xs-6 manufacture" style="margin-bottom:20px">
									<div class="img"><img src="/img/manufacture/' . $manu['manufacture_id'] . '.' . $manu['img'] . '" alt=""></div>
									<p>' . $manu['name'] . '</p>
								</div>
							';
						echo Html::a($res,['/site/services', 'manufacture_id' => $manu['manufacture_id']]);
					}; 
				?>
			</div>
			<!-- /.row complect -->
		</div>
	</section>
	
	<?php echo Yii::$app->runAction('/site/renderseparator') ?>
	
	<section id="s03" class="pad95">
		<div class="container">
			<h2 class="gradient"><span>С НАМИ РАБОТАТЬ НАДЕЖНО</span></h2>
			<div class="row tac">
				<div class="col-md-4 col-sm-6">
					<div class="img"><img src="/img/Dogovor.png"></div>
					<p>Работаем официально <br> по договору</p>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="img"><img src="/img/Firma.png"></div>
					<p>Полный пакет документов <br> для юридических лиц</p>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="img"><img src="/img/Opit.png"></div>
					<p>Опыт работы <br> с 2011 года</p>
				</div>
				<div class="col-md-4 col-md-offset-2 col-sm-6">
					<div class="img"><img src="/img/Teploobmen.png"></div>
					<p>Промыли более <br> 568 теплообменнов</p>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="img"><img src="/img/Zip.png"></div>
					<p>Установили и заменили более<br> 1568 пластин и прокладок</p>
				</div>
			</div>
		</div>
	</section>

	<?php echo Yii::$app->runAction('/site/renderseparator') ?>

	<?php echo Yii::$app->runAction('/site/rendercases') ?>

	<section id="s05">
		<div class="container">
			<h2>Преимущества работы с нами:</h2>
			<div class="row">
				<div class="col-md-5">
				
					<ul class="tar">
						<li>Оперативная работа <br> без затягивания сроков</li>
						<li>Выезд на объект в течении <br> первого дня обращения</li>
						<li>Использование качественных <br> запасных частей</li>
						<li>Подменный пакет ЗИП пластин <br> прокладок (экстренный ремонт)</li>
						<li>Использование профессионального <br> инструмента и оборудования</li>
						<li>Использование сертифицированной <br> промывочной жидкости</li>
					</ul>
				</div>
				<div class="col-md-2 tac pad0 hidden-sm hidden-xs"><img src="/img/Teploeffect.png"></div>
				<div class="col-md-5">
					<ul class="tal">
						<li>Среднее время промывки <br> занимает 3 ч. 10 мин</li>
						<li>Предоставляем гарантию <br> на все работ сроком 1 год</li>
						<li>Оповещение и контроль на каждом <br> этапе выполнения работы</li>
						<li>Предоставление всех необходимых  <br> документов о проведенной работе</li>
						<li>После нас всегда чисто (утилизация и <br> вывоз отработанных запасных частей)</li>
						<li>Рекомендации и рекомендательные <br> письма для выше стоящих организаций</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<?php echo Yii::$app->runAction('/site/rendertarifs') ?>

	<section id="s07">
		<div class="container">
			<h2>Порядок работы</h2>
			<div class="row tac mt-1">
				<div class="col-md-2 col-md-offset-1">
					<div class="img"><img src="/img/Tech.png"></div>
					<p>1. Обнаруживаете <br> течь</p>
				</div>
				<div class="col-md-2">
					<div class="img"><img src="/img/Call.png"></div>
					<p>2. Звоните <br> нам</p>
				</div>
				<div class="col-md-2">
					<div class="img"><img src="/img/Lupa.png"></div>
					<p>3. Мы выезжаем и <br> осматриваем</p>
				</div>
				<div class="col-md-2">
					<div class="img"><img src="/img/Dogovor2.png"></div>
					<p>4. Заключаем <br> договор</p>
				</div>
				<div class="col-md-2">
					<div class="img"><img src="/img/Work.png"></div>
					<p>5. Выполняем <br> работы</p>
				</div>
				<div class="col-md-2 col-md-offset-2">
					<div class="img"><img src="/img/Priem.png"></div>
					<p>6. Принимаете <br> работу</p>
				</div>
				<div class="col-md-2">
					<div class="img"><img src="/img/Oplata.png"></div>
					<p>7. Оплачиваете</p>
				</div>
				<div class="col-md-2">
					<div class="img"><img src="/img/Documents.png"></div>
					<p>8. Подписываем <br> документы</p>
				</div>
				<div class="col-md-2">
					<div class="img"><img src="/img/Recomend.png"></div>
					<p>9. Рекомедуете <br> нас </p>
				</div>
			</div>
			<!-- row -->
		</div>
	</section>

	<?php echo Yii::$app->runAction('/site/renderfaq') ?>

	<?php echo Yii::$app->runAction('/site/renderseparator') ?>

	<?php echo Yii::$app->runAction('/site/rendervideo') ?>

	<section id="s010">
		<div class="container">
			<h2>С нами работают</h2>
			<div class="row tac">
				<div class="col-md-2 col-sm-4 col-xs-6">
					<p>МПЗ</p>
					<div class="img"><img src="/img/mpz.png"></div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6">
					<p>ТСЖ № 45</p>
					<div class="img"><img src="/img/img2.png"></div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6">
					<p>роснефть</p>
					<div class="img"><img src="/img/img3.png"></div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6">
					<p>газпром</p>
					<div class="img"><img src="/img/img4.png"></div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6">
					<p>тэц 24</p>
					<div class="img"><img src="/img/img5.png"></div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6">
					<p>сбербанк</p>
					<div class="img"><img src="/img/img6.png"></div>
				</div>
			</div>
		</div>
	</section>

	<section id="s011" class="pad95">
		<div class="container">
			<h2><span>о компании</span></h2>
			<div class="row">
				<div class="col-md-4 mt8 tac"><img src="/img/man.jpg"></div>
				<div class="col-md-8 mt8">
					<p>Компания была основана в 2008 году, и в настоящее время является одной из ведущих в области бытовой и промышленной водоочистки и водоподготовки в Северо-Западном федеральном округе. Основой успешной работы и динамичного развития нашей компании стал накопленный опыт в создании систем водоподготовки в различных отраслях промышленности и социальной сферы, ориентация в деятельности на самые высокие европейские и мировые стандарты.</p>

					<p>Наши установки водоочистки успешно эксплуатируются на многих промышленных предприятий, где доказали свою эффективность и надежность. Вы можете убедиться в этом, посетив наш раздел выполненных работ.</p>

					<p>В своей работе мы опираемся на колоссальный интеллектуальный потенциал дружного и сплоченного коллектива, в составе которого трудятся высококвалифицированные специалисты.</p>

					<p>На сегодняшний день наша компания оказывает всестороннюю техническую и информационную поддержку инжиниринговым компаниям и проектным организациям, персоналу организаций-потребителей, эксплуатирующему системы очистки воды.</p>

					<p>«Теплоэффект» - компания, предлагающая не просто инновационное оборудование и решения. Прежде всего, мы предлагаем взаимовыгодное сотрудничество.</p>
				</div>
			</div>
		</div>
	</section>
	
	<?php echo Yii::$app->runAction('/site/rendercertificate') ?>
	