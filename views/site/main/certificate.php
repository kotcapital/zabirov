<section id="s012" style="margin-bottom:20px">
	<div class="container">
		<h2><span>Сертификаты</span></h2>
		<div class="row">
			<?php
				foreach ($certificate as $c) {
					echo 
						'
							<div class="col-xs-6" style="margin-top:30px">
								<h3 class="text text-center" style="margin-bottom:15px">' . $c['name'] . '</h3>
								<img class="img-responsive" src="/img/certificate/' . $c['certificate_id'] . '.' . $c['img'] . '">
							</div>
						';
				}
			?>
		</div>
	</div>
</section>