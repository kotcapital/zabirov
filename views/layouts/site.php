<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAsset;

SiteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
	<title> Теплоэффект </title>
	
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	<!-- BEGIN NAVIGATION -->
	<nav id="nav">
		<div class="container">
			<div class="row flex aic">

		    <div class="navbar-header col-md-2">
			  <?=  Html::a(Html::img('/img/logo.png', ['class' => 'navbar-brand']), 'index') ?>
		    </div>
		    <!-- navbar-header -->
		    <div class=" navbar-collapse col-md-6" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
				<li><?= Html::a('Главная', ['site/index#s01']) ?></li>
				<li><?= Html::a('Услуги', ['site/services']) ?></li>
				<li><?= Html::a('О компании', ['site/index#s011'], ['class' => 'scrollto']) ?></li>
				<li><?= Html::a('Как работаем', ['site/index#s07'], ['class' => 'scrollto']) ?></li>
				<li><?= Html::a('Контакты', ['site/index#footer'], ['class' => 'scrollto']) ?></li>
		      </ul>
		    </div>
		    <!-- navbar-collapse -->
		    <div class="col-md-2 contacts">
		    	<a href="tel:8 919 492 65 64" class="phone flex aic nowrap">
		    		<img src="/img/phone.png" alt="">
		    		8 919 492 65 64
		    	</a>
		    	<a href="mailto:teploeffect@gmail.ru" class="email flex aic nowrap">
		    		<img src="/img/mail.png" alt="">
		    		teploeffect@gmail.ru
		    	</a>
		    </div>
		    <!-- /.col-md-3 contacts -->
		    <div class="col-md-2 btn-container">
		    	<a href="#x" class="btn nowrap" onclick="popup(1, this)" data-popup-text="Заказать звонок">
		    		<span><strong>Заказать звонок</strong></span>
		    	</a>
		    </div>
		    <div class="col-md-2 burger_menu">
		   		<a href="#x" id="toggle_menu" class="toggle_menu">
		   			<span></span>
		   			<span></span>
		   			<span></span>
		   		</a>
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
					<p>ИП Забиров Дмитрий Ринатович</p>
					<p>614002, г. Пермь, ул. Николая Островского 93 в</p>
					<p>Тел./факс: <a href="tel:8 952 64 45 725">8 952 64 45 725</a></p>
					<p>E-mail: <a href="mailto:teploeffekt2018@mail.ru">teploeffekt2018@mail.ru</a></p>
					<img src="/img/office.png" class="office">
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
		  <form action="spasibo.php" method="post">
			<input type="text" name="name" placeholder="Имя">
					<input type="text" name="tel" placeholder="Телефон или почта" required="">
					<input type="hidden" name="comment">
			<input type="submit" value="Отправить">
		  </form>
		</div>    
	  </div>
	</div>

	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=f0ba2a54-dcb7-4e30-8857-5a3054e6824b" type="text/javascript"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
