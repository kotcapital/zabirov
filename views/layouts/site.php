<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAsset;
use app\models\Contact;
use app\models\Site;

SiteAsset::register($this);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/img/favicon.ico']);


$check = Site::checkDomain($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
if ($check != null) {
	return Yii::$app->response->redirect($check);
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="yandex-verification" content="2ada6d988fb12aa0" />
	<meta name="google-site-verification" content="4PlvlqO444BL_vdmAYrxsppalwd-nkG4bfJWHhaOx3A" />
	<title><?= Html::encode($this->title) ?></title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	<!-- BEGIN NAVIGATION -->
	<nav id="nav">
		<div class="container">
			<div class="row flex aic">

		    <div class="navbar-header col-md-2">
			  <?=  Html::a(Html::img('/img/logo.png', ['class' => 'navbar-brand']), '/') ?>
		    </div>
		    <!-- navbar-header -->
		    <div class=" navbar-collapse col-md-6" id="bs-example-navbar-collapse-1">
		       <ul class="nav navbar-nav">
					<li class="col-md-3 text text-center"><?= Html::a('Главная', ['site/index#s01']) ?></li>
					<li class="col-md-4 text text-center"><?= Html::a('Магазин', ['site/services'],['style' => 'padding-left:9px;padding-right:9px;']) ?></li>
					<li class="col-md-5 text text-center"><?= Html::a('О компании', ['site/index#s011'], ['class' => 'scrollto']) ?></li>
					<li class="col-md-3 text text-center"><?= Html::a('Контакты', ['site/index#footer'], ['class' => 'scrollto']) ?></li>
					<li class="col-md-4 text text-center"><?= Html::a('Как работаем', ['site/index#s07'], ['class' => 'scrollto']) ?></li>
					<li class="col-md-5 text text-center"><?= Html::a('Опросный лист', ['#'], ['data-toggle' => 'modal', 'data-target' => '#list_of_questionnaires']) ?></li>
				  </ul>
		    </div>
		    <!-- navbar-collapse -->
		    <div class="col-md-2 contacts">
				<?php
					$link_phone = 'tel:' . Html::encode(Contact::value(Contact::PHONE));
					$label_phone = '<img src="/img/phone.png" alt="">' . Html::encode(Contact::value(Contact::PHONE));
					echo Html::a($label_phone, $link_phone, ['class' => 'phone flex aic nowrap']);
				?>
				<?php
					$link_email = 'mailto:' . Html::encode(Contact::value(Contact::EMAIL));
					$label_email = '<img src="/img/mail.png" alt="">' . Html::encode(Contact::value(Contact::EMAIL));
					echo Html::a($label_email, $link_email, ['class' => 'email flex aic nowrap']);
				?>
		    </div>
		    <!-- /.col-md-3 contacts -->
		    <div class="col-md-2 btn-container">
				<?php
					$label1 = '<span><strong>Заказать звонок</strong></span>';
					echo Html::a($label1, '#x', [
						'class' => 'btn nowrap order',
						'onclick' => 'popup(1, this)',
						'comment' => 'Заказ звонка'
					]);
				?>
		    </div>
		    <div class="col-md-2 burger_menu">
				<?php
					$label = '<span></span>
		   			<span></span>
		   			<span></span>';
					echo Html::a($label, '#x', ['class' => 'toggle_menu', 'id' => 'toggle_menu']);
				?>
		    </div>
			</div>
			<!-- /.row -->
		</div>
	</nav>
	<!-- END NAVIGATION -->



<?= $content ?>


	<!-- BEGIN FOOTER -->
	<footer id="footer">
			<div class="row flex flex-wrap">
				<div class="col-md-6" id="map"></div>
				<div class="col-md-6 contacts">
					<h2>Контакты</h2>
					<p><?php echo Html::encode(Contact::value(Contact::NAME));?></p>
					<p><?php echo Html::encode(Contact::value(Contact::ADRESS));?></p>
					<p>Тел./факс:
						<?php
							$link_phone_footer = 'tel:' . Html::encode(Contact::value(Contact::PHONE));
							$label_phone_footer = Html::encode(Contact::value(Contact::PHONE));
							echo Html::a($label_phone_footer, $link_phone_footer);
						?>
					</p>
					<p>E-mail:
						<?php
							$link_email_footer = 'mailto:' . Html::encode(Contact::value(Contact::EMAIL));
							$label_email_footer = Html::encode(Contact::value(Contact::EMAIL));
							echo Html::a($label_email_footer, $link_email_footer);

						?>
					</p>
					<p>
					<img src="/img/office.png" class="office">
					</p>
					<p>
					<?php echo Html::a('Политика конфиденциальности', ['/site/confidence'],['target' => '_blank']);?>
					Разработано: <a href="https://babayweb.ru" class="babay" target="_blank">babay.web</a>
					</p>

				</div>
			</div>
		</footer>
	<!-- END FOOTER -->

	<div class="modal fade bs-example-modal-lg" style="z-index:9999" id="questionnaire" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text text-center" id="myModalLabel">Введите данные для расчета</h4>
				</div>
				<div class="modal-body questionnaire" style="padding-top:0px">
					<form action="/site/formsubmit" method="post" style="width:auto;padding-left:0px;padding-right:0px">
						<div class="row">
							<div class="col-xs-12">
								<input style="margin-top:0px" class="form-control" placeholder="Мощность(тепловая нагрузка)" name="power">
							</div>
							<div class="col-xs-12">
								<div class="col-xs-12 col-md-4">
									<div class="col-xs-12" style="margin-bottom:15px;margin-top:5px">
										<input class="form-control" placeholder="t°C греющей среды(вход.)" name="temperature of the heating medium(in)">
									</div>
									<div class="col-xs-12" style="margin-bottom:15px;margin-top:25px">
										<input class="form-control" placeholder="t°C греющей среды(выход.)" name="temperature of the heating medium(out)">
									</div>
									<div class="col-xs-12" style="margin-bottom:15px">
										<input class="form-control" placeholder="Тип греющей среды" name="type of the heating medium">
									</div>
									<div class="col-xs-12" style="margin-bottom:15px">
										<p>Допускаем потери напора в ПТО для греющей среды, макс.</p>
										<input style="margin-top:0px" class="form-control">
									</div>
								</div>
								<div class="col-md-4 hidden-xs image_questionnaire">
									<div class="col-xs-12">
										<img src="/img/gotova.png" class="img-responsive" style="margin: 0 auto" a/>
									</div>
								</div>
								<div class="col-xs-12 col-md-4">
									<div class="col-xs-12" style="margin-bottom:15px;margin-top:5px">
										<input class="form-control" placeholder="t°C нагретой среды(выход.)" name="temperature of the heated medium(out)">
									</div>
									<div class="col-xs-12" style="margin-bottom:15px;margin-top:25px">
										<input class="form-control" placeholder="t°C нагретой среды(вход.)" name="temperature of the heated medium(in)">
									</div>
									<div class="col-xs-12" style="margin-bottom:15px">
										<input class="form-control" placeholder="Тип нагретой среды" name="type of heated medium">
									</div>
									<div class="col-xs-12" style="margin-bottom:15px">
										<p>Допускаем потери напора в ПТО для нагрев.среды, макс.</p>
										<input style="margin-top:0px" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-xs-12">
								<p style="font-size:16px;margin-bottom:5px" class="text text-center">Дополнительные сведения и требования</p>
								<textarea class="form-control" rows="2"></textarea>
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
			</div>
		</div>
	</div>


	<div class="modal fade bs-example-modal-lg" style="z-index:9999" id="list_of_questionnaires" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text text-center" id="myModalLabel">Опросные листы</h4>
				</div>
				<div class="modal-body" style="padding-top:0px">
					<div class="row">
						<h4 class="text text-center" style="margin-bottom:20px;margin-top:20px">Опросные листы на теплообменное оборудование</h4>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/oprosniy-list-teploobmennoe-oborudovanie-ridan-zhidkost-zhidkost-.doc" style="font-size:14px">Теплообменное оборудование Ридан для отопления</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/oprosniy-list-teploobmennoe-oborudovanie-prom.doc" style="font-size:14px">Теплообменное оборудование Ридан для промышленного назначения</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/oprosniy-list-teploobmennoe-oborudovanie-posledovat.doc" style="font-size:14px">Теплообменники Ридан для двухступенчатой последовательной схемы ГВС</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/oprosniy-list-teploobmennoe-oborudovanie-smeshannoe.doc" style="font-size:14px">Теплообменники для двухступенчатой смешанной схемы ГВС</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/oprosniy-list-teplovoi-punkt.doc" style="font-size:14px">Блочный тепловой пункт</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/oprosnyj-list-teploobmennik-alfa-laval.doc" style="font-size:14px">Пластинчатый теплообменник Альфа Лаваль</a></br>
						</div>
						<h4 class="texte text-center" style="margin-bottom:20px">Опросные листы на насосы</h4>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/vertikalnie_polopogrygnie_nasosi_2_.xls" style="font-size:14px">Вертикальные полупогружные насосы</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/skvazhinnienasosi.xls" style="font-size:14px">Скважинные насосы</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/Questionnaire_Chemical_Fluids_-_Sales_RU_01.xls" style="font-size:14px">Стандартного оборудования с агрессивными жидкостями</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/opr-list-shnekovie-nasosu.doc" style="font-size:14px">Шнековые насосы</a></br>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<span class="glyphicon glyphicon-save"></span><a href="/questionnaires/oborudovanie-dly-vodopodgotovki.doc" style="font-size:14px">Оборудование для водоподготовки</a></br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="popup-bg" id="popup-bg">
		<div class="popup" id="popup1">
			<div class="head">
				<div class="close" onclick="popup(-1)">&times;</div>
				<span>Заполните форму</span>
			</div>
			<div class="content">
				<p>и мы свяжемся с Вами <br> в ближайшее время</p>
				<form action="/site/formsubmit" method="post">
					<input type="text" name="name" placeholder="Имя">
					<input type="text" name="tel" placeholder="Телефон или почта" required="">
					<div id="orderForm">
					</div>
					<input type="submit" value="Отправить">
					<p class="policy">Нажимая на кнопку "Отправить" <br> Вы подтверждаете свое согласие на <br> обработку Ваших персональных данных</p>
				</form>
			</div>
		</div>
	</div>




	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=f0ba2a54-dcb7-4e30-8857-5a3054e6824b" type="text/javascript"></script>
	<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>

	<!-- VK Widget -->
	<div id="vk_community_messages"></div>
	<script type="text/javascript">
	VK.Widgets.CommunityMessages("vk_community_messages", 181649277, {tooltipButtonText: "Задайте нам вопрос"});
	</script>

	<!— Yandex.Metrika counter —>
	<script type="text/javascript" >
	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
	m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym(53684290, "init", {
	clickmap:true,
	trackLinks:true,
	accurateTrackBounce:true
	});
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/53684290" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!— /Yandex.Metrika counter —>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
