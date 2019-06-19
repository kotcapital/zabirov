<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Site;

AppAsset::register($this);


//return print_r($_SERVER['REQUEST_URI']);
$check = Site::checkDomain($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
if ($check != null) {
	return Yii::$app->response->redirect($check);
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
    $login = "";
	$changePass = '<li>' . Html::a('Сменить пароль',['/settings/changepass']) . '</li>';
	$users = "";
	if (Yii::$app->user->can('rbacManage')) {
		$users = '<li>' . Html::a('Пользователи',['/user/admin']) . '</li>';
	}
	$rights = "";
	if (Yii::$app->user->can('rbacManage')) {
		$rights = '<li>' . Html::a('Права', ['/user/rbac']) . '</li>';
	}
	
	$contacts = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Контакты', ['/contact/update']) . '</li>' : '');
	$cases = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Кейсы', ['/cases/index']) . '</li>' : '');
	$tarifs = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Тарифы', ['/tarifs/index']) . '</li>' : '');
	$faq = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Вопросы', ['/faq/index']) . '</li>' : '');
	$video = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Видео', ['/video/index']) . '</li>' : '');
	$catalog = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Каталог', ['/catalog/index']) . '</li>' : '');
	$category = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Категории', ['/category/index']) . '</li>' : '');
	$middle = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Подкатегории', ['/middle/index']) . '</li>' : '');
	$subcategory = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Подподкатегории', ['/subcategory/index']) . '</li>' : '');
	$manufacture = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Производители', ['/manufacture/index']) . '</li>' : '');
	$filters = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Фильтры', ['/filters/index']) . '</li>' : '');
	$certificate = (Yii::$app->user->can('settings') ? '<li>' . Html::a('Сертификаты', ['/certificate/index']) . '</li>' : '');
	
	if (Yii::$app->user->isGuest) {
		$login = '<li>' . Html::a('Вход', ['/login']) . '</li>';
	} else {
		$login = '<li class="dropdown" id="settingsdrop">
			<a href="#" class="dropdown-toggle keep_open"  data-toggle="dropdown" >' . Yii::$app->user->identity->username . '</a>
					<ul class="dropdown-menu keep_open" id="settings">
					<li>' . Html::a('Выход',['/logout']) . '</li>
					' . $changePass . '
					<li class="divider"></li>
					' . $users . '
					' . $rights . '
					' . $category . '
					' . $middle . '
					' . $filters . '
					' . $certificate . '
					<li class="divider"></li>
					<li class="disabled"><a href="#" >Справочники</a></li>
					</ul>
				</li>';

	}

	
	
	
?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            $contacts, $cases, $tarifs, $faq, $video, $manufacture, $catalog, $login
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
