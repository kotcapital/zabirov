<?php
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAsset;
use app\models\Video;
?>
<section id="s09" class="pad95">
		<div class="container">
			<h2 class="gradient"><span>Видео последних выполненных работ</span></h2>
			<div class="row tac">
				<?php
					$cnt = 1;
					echo '<div class="row">';
					foreach (Video::find()->all() as $video) {
						echo '
							
								<div class="col-md-4 col-sm-6 col-xs-6">
									<p>' . Html::encode($video['title']) . '</p>
									<iframe 
										width="auto" 
										height="auto" 
										src="' . Html::encode($video['link']) . '" 
										frameborder="0" 
										allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
										allowfullscreen>
									</iframe>
								</div>
						';
						if ($cnt % 3 == 0) {
								if ($cnt){
									echo '</div>';
									echo '<div class="row">';
								}
							}
						
						$cnt++;	
					}
				?>
			</div>
		</div>
	</section>