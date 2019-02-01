
<section class="header_line">
	<div class="container">
		<h2>Наши услуги</h2>
	</div>
</section>

<section id="services" class="singlePge">
	<div class="container flex">
		<div class="sidebar">
			<div class="close">&times;</div>
			<p class="price">Цена, ₽</p>
			<form class="filterForm" method="post">
				<div class="inputs flex jcsb">
					<div class="form_control before price_controls">
						<input type="text" class="sliderValue" data-index="0" value="500" />
					</div>
					<div class="form_control after price_controls">
						<input type="text" class="sliderValue" data-index="1" value="3500" />
					</div>
				</div>
				<!-- inputs -->
				<div id="slider">
					<span class="coloredLine first"></span>
					<span class="coloredLine last"></span>
				</div>
				<!-- slider -->
				<div class="dropdown">
					<p class="flex aic dropdown_list_toggle"><img src="/img/strelka.png"> Выпадающий список</p>
					<div class="dropdown_checkboxes checkboxes">
						<div class="form_control">
							<input type="checkbox" name="filter" id="filter_1_1" value="">
							<label for="filter_1_1">Пункт чек-бокса</label>
						</div>
						<div class="form_control">
							<input type="checkbox" name="filter" id="filter_1_2" value="">
							<label for="filter_1_2">Пункт чек-бокса</label>
						</div>
						<div class="form_control">
							<input type="checkbox" name="filter" id="filter_1_3" value="">
							<label for="filter_1_3">Пункт чек-бокса</label>
						</div>
						<div class="form_control">
							<input type="checkbox" name="filter" id="filter_1_4" value="">
							<label for="filter_1_4">Пункт чек-бокса</label>
						</div>
						<div class="form_control">
							<input type="checkbox" name="filter" id="filter_1_5" value="">
							<label for="filter_1_5">Пункт чек-бокса</label>
						</div>
						<div class="form_control">
							<input type="checkbox" name="filter" id="filter_1_6" value="">
							<label for="filter_1_6">Пункт чек-бокса</label>
						</div>
					</div>
				</div>
				<!-- dropdown_checkboxes -->
				<div class="checkboxes static_checkboxes">
					<div class="form_control">
						<input type="checkbox" name="filter" id="filter_1" value="">
						<label for="filter_1">Пункт чек-бокса</label>
					</div>
					<div class="form_control">
						<input type="checkbox" name="filter" id="filter_2" value="">
						<label for="filter_2">Пункт чек-бокса</label>
					</div>
					<div class="form_control">
						<input type="checkbox" name="filter" id="filter_3" value="">
						<label for="filter_3">Пункт чек-бокса</label>
					</div>
					<div class="form_control">
						<input type="checkbox" name="filter" id="filter_4" value="">
						<label for="filter_4">Пункт чек-бокса</label>
					</div>
					<div class="form_control">
						<input type="checkbox" name="filter" id="filter_5" value="">
						<label for="filter_5">Пункт чек-бокса</label>
					</div>
					<div class="form_control">
						<input type="checkbox" name="filter" id="filter_6" value="">
						<label for="filter_6">Пункт чек-бокса</label>
					</div>
				</div>
				<!-- checkboxes -->
				<div class="search">
					<input type="search" name="search">
				</div>
				<!-- /.search -->
				<button type="submit">Найти</button>
			</form>
		</div>
		<main>
			<div class="header">
				<div class="img"><img src="/img/productFull.jpg"></div>
				<div class="text">
					<p class="service_name">Ремонт</p>
					<p class="service_price">от 4 500, ₽</p>
				</div>
			</div>
			<!-- header-->
			<div class="body">
				<ul class="sercive_tabs">
					<li class="active">Описание</li>
					<li>Характеристики</li>
					<li>Фото</li>
					<li>Опросный лист</li>
				</ul>
				<!-- sercive_tabs -->
				<div class="content_block">
					<div class="switch_block active">
						<p>Для того , чтобы рассчитать и получить цену на теплообменник с параметрами, отличающимися от указанных в описании, заполните и отправьте Опросный лист. Вы также можете указать требуемые технические параметры в поле "Комментарий" в форме "Быстрого заказа".</p>
					</div>
					<div class="switch_block">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
					<div class="switch_block">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
					<div class="switch_block">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
			</div>
			<!-- /.body -->
		</main>
	</div>
</section>


<?php echo Yii::$app->runAction('/site/renderseparator') ?>
