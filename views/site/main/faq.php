<?php
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAsset;
use app\models\Faq;
?>
<section id="s08" class="pad95">
		<div class="container">
			<h2 class="gradient"><span>часто задаваемые вопросы</span></h2>
			<div class="row">
				<div class="col-md-5 pad0 mt5">
					<div class="faq_block">
						<div class="inner">
							<?php
								$cnt = 1;
								foreach(Faq::find()->all() as $faq) {
									if ($cnt == 1) {
										echo '
											<div class="switch_content active">
												<p class="title">' . Html::encode($faq['question']) . '</p>
												<p class="text">' . $faq['answer'] . '</p>
											</div>
										';
									}else{
										if($cnt > 1){
											echo '<div class="switch_content hidden">
												<p class="title">' . Html::encode($faq['question']) . '</p>
												<p class="text">' . $faq['answer'] . '</p>
											</div>';
										}
									}
									$cnt++;
								}
							?>
						<!-- /.switch_content -->
						</div>
					</div>
					<!-- /.faq_block -->		
				</div>
				<div class="col-md-7 mt5">
					<ul class="faq_list">
						<?php 
							$cnt = 0;
							foreach (Faq::find()->asArray()->all() as $faq) {
								if ($cnt == 0) {
									echo '<li class="active">' . $faq['question'] . '</li>';
								}else{
									if ($cnt >= 1) {
										echo '<li>' . $faq['question'] . '</li>';
									}
								}
								$cnt++;
							}
						?>
					</ul>
				</div>
			</div>
			<!-- /.row -->
		</div>
	</section>