<?php 
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAsset;
use app\models\Cases;
?>
<section id="s04">
		<div class="container">
			<h2 class="gradient"><span>кейсы</span></h2>
			<div class="cases flex flex-wrap jcsb">
				<?php
				foreach (Cases::find()->all() as $cases) {
					echo '
						<div class="block">
							<img src="/img/cases/' . $cases['cases_id'] . '.' . $cases['img'] . '">
							<p class="case_title">' . Html::encode($cases['title']) . '</p>
							<div class="case_description">
								<div class="header">
									<div class="before">
											<p class="small">Траты до:</p>
											<p class="money">' . Html::encode($cases['before']) . '₽</p>
										</div>
										<div class="after">
											<p class="small">Траты после:</p>
											<p class="money">' . Html::encode($cases['after']) . '₽</p>
										</div>
									</div>
									<div class="body">
										<p class="small">Сделано:</p>
										<p class="done">' . Html::encode($cases['description']) . '</p>
									</div>
									<div class="footer">
										<p class="small">Сократили расходы на</p>
										<p class="percent">' . Html::encode($cases['difference']) . '%</p>
									</div>
								</div>
								<!-- /.case_description -->
							</div>
						';
				}
				
				
				
				?>
			</div>
			<!-- /.cases -->
		</div>
	</section>