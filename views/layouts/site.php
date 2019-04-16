<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAsset;
use app\models\Contact;

SiteAsset::register($this);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/img/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
				<li><?= Html::a('Главная', ['site/index#s01']) ?></li>
				<li><?= Html::a('Магазин', ['site/services'],['style' => 'padding-left:9px;padding-right:9px;']) ?></li>
				<li><?= Html::a('О компании', ['site/index#s011'], ['class' => 'scrollto']) ?></li>
				<li><?= Html::a('Как работаем', ['site/index#s07'], ['class' => 'scrollto']) ?></li>
				<li><?= Html::a('Контакты', ['site/index#footer'], ['class' => 'scrollto']) ?></li>
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
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
