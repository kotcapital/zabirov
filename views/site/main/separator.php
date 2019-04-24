<?php
use yii\helpers\Html;
use app\models\Contact;
?>
	<section class="separator">
		<div class="container">
			<div class="row flex aic flex-wrap tac">
				<div class="col-md-6">
					<h3>ПОЛУЧИТЬ БЕСПЛАТНУЮ КОНСУЛЬТАЦИЮ <br class="hidden-sm"> СПЕЦИАЛИСТА МОЖНО ПО ТЕЛЕФОНУ </h3>
				</div>
				<div class="col-md-4 tar">
					<?php
						$link = 'tel:' . Html::encode(Contact::value(Contact::PHONE));
						$label = '<img src="/img/phone_white.png">' . Html::encode(Contact::value(Contact::PHONE));
						echo Html::a($label, $link, ['class' => 'phone flex aic nowrap', 'name' => 'call']);
					?>
				</div>
				<div class="col-md-2">
					<?php
						$label = '<span><strong>Заказать звонок</strong></span>';
						echo Html::a($label, '#x', ['class' => 'btn flex aic jcc order',  'onclick' => 'popup(1, this)', 'comment' => 'Заказ звонка']);
					?>
				</div>
			</div>
		</div>
	</section>
	
