

<section class="header_line">
	<div class="container">
		<h2>Наши услуги</h2>
	</div>
</section>

<section id="services" class="ajaxLoadServices">
	<div class="container flex">
		<!-- BEGIN SIDEBAR -->
	<aside>
		<ul class="breadcrumbs nowrap">
			<li><a href="#x">ЗИП</a></li>
			<li><a href="#x">Категория1</a></li>
			<li><a href="#x">Подкатегория1</a></li>
		</ul>
		<a class="filters btn"><span><strong>Фильтры</strong></span></a>
		<!-- breadcrumbs -->
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
		<!-- /.sidebar -->
	</aside>

	<!-- END SIDEBAR -->
		<main>
			<?php echo Yii::$app->runAction('/site/renderproductlist') ?>
		</main>
	</div>
</section>


<?php echo Yii::$app->runAction('/site/renderseparator') ?>

