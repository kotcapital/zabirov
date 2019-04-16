<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use budyaga\users\models\User;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Tarifs;
?>

<section id="s06" class="pad95">
		<div class="container">
			<h2 class="gradient"><span>тарифы</span></h2>
			<div class="tarifs flex jcsa tac">
				<?php 
				foreach (Tarifs::find()->all() as $tarifs) {
					echo '
						<div class="block" onclick="popup(1, this)" data-popup-text="' . Html::encode($tarifs['name']) . ' до ' . Html::encode($tarifs['amount']) . ' шт.">
							<div class="inner">
								<p>' . Html::encode($tarifs['name']) . '</p>
								<p class="big">до ' . Html::encode($tarifs['amount']) . ' шт.</p>
								<p class="big mt1">' . Html::encode($tarifs['price']) . ' ₽</p>
								<p class="mt-1">за штуку</p>
								' . Html::a('Отправить заявку', ['#x'], [
									'class' => 'btn mt2 order',
									'name' => $tarifs['name'],
									'amount' => $tarifs['amount'],
									'price' => $tarifs['price'],
									'comment' => 'Заявка на тариф',
								]) . '
							</div>
						</div>
					';
				}
				
				?>
				
			</div>
		</div>
	</section>