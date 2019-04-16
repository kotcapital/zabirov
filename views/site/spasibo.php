<?php
use yii\helpers\Html;

$imail="teploeffekt2018@mail.ru"; //Email (можно через запятую - email1, email2, email3)
$ireply=""; //Email для ответа (нажимая на ''отправить'' клиент отправит сообщение на этот email)
$tiny_text="спасибо за вашу заявку, мы свяжемся с вами в ближайшее время."; //Благодарность
$ntimer=""; //Таймер возврата на главную, в секундах - после успешного заказа, по истичению заданного времени заказчика перекинет на главную страницу
$kod_kod=""; //Скрипты

?>
<!DOCTYPE HTML>
<html style="height: 100%; font-family: 'Lato', Calibri, Arial, sans-serif;">
<head>
  <meta http-equiv="content-type" content="text/html" />
  <meta name="author" content="smok003" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, user-scalable=false"/>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">

<?php
if (
    (isset($_POST['phone']) && strlen($_POST['phone']) > 6) || 
    (isset($_POST['tel'])   && strlen($_POST['tel']) > 6)
) {

  $message = '';
  $client = '';

  $post = array(
    'имя'     => 'Имя: ',           'name'   => 'Имя: ',
    'tel'     => 'Телефон: ',       'phone'  => 'Телефон: ',       'contact'    => 'Контакты: ',
    'skype'   => 'Скайп: ',         'fb'     => 'Фейсбук: ',       'vk'         => 'Вконтакте: ',
    'mail'    => 'Email: ',         'email'  => 'Email: ',

    /* стандартные доп поля */
    'notes'   => 'Комментарий: ',   'note'   => 'Комментарий: ',   'comment'    => 'Комментарий: ',
    'payment_type' => 'Тип оплаты: ',
    'adres'   => 'Адрес: ',         'adress' => 'Адрес: ',         'address'    => 'Адрес: ',     'addr'  => 'Адрес: ',
    'shipping'=> 'Отправка: ',
    'add'     => 'Дополнительно: ', 'dop'    => 'Дополнительно: ', 'additional' => 'Дополнительно: ',
    'cena'    => 'Цена: ',          'cost'   => 'Цена: ',          'price'      => 'Стоимость: ', 'total_price' => 'Итого: ',
    'subject' => 'Тема: ',          'theme'  => 'Тема: ',
    'tovar'   => 'Товар: ',			
    'count'   => 'Количество: ',	'category' => 'Категория товара: ',		'middle' => 'Подкатегория товара: ',
    'message' => 'Сообщение: ',		'manufacture' => 'Производитель: ',		'amount' => 'Количество',
    'inn'     => 'ИНН: ',			'param' => 'Параметры',
    'birthdate' => 'Дата рождения: ',
    'passport' => 'Паспорт: ',

    /* свойства обьектов */
    'size'      => 'Размер: ',      'width'   => 'Ширина: ',       'height'     => 'Высота: ',    'length'  => 'Длинна: ',
    'color'     => 'Цвет: ',        'format'  => 'Формат: ',
    'view'      => 'Вид: ',         'kind'    => 'Вид: ',      
    'weight'    => 'Вес: ',         'veight'  => 'Вес: ',          'wt'         => 'Вес: ',
    'figure'    => 'Фигура: ',      'shape'   => 'Фигура: ',
    'structure' => 'Структура: ',   'pattern' => 'Структура: ',    'texture'    => 'Структура: ',
    'design'    => 'Дизайн: ',      'styling' => 'Дизайн: ',
    'imgsrc'    => 'Картинка: ',    'img'     => 'Картинка: ',
    'referrer'  => 'Реферал: ',     'ref'     => 'Реферал: ',
    'title'     => 'Заголовок (название): ',
    'type'      => 'Тип: ',
    'forma'     => 'Форма: ',
    'question'  => 'Вопрос: ',
    'date'      => 'Дата: '
  );

function frarr($arr){
  global $post;

  $r = '';
  foreach ($arr as $k => $v) {
    if (is_array($v))
      $r .= frarr($v);
    else
        $r .= ( $post[$k] ? $post[$k] : ($k . ': ') ) . $v . PHP_EOL;
  }

  return $r;
}

  foreach ($_POST as $key => $value) {
    if (is_array($value)) {
      $message .= ( $post[$key] ? $post[$key] : ($key . ': ') )  . PHP_EOL .  frarr($value) . PHP_EOL;
    } else
      $message .= ( $post[$key] ? $post[$key] : ($key . ': ') ) . $value . PHP_EOL;
	}
	$header = 'Content-type: text/plain; charset=UTF-8' . PHP_EOL . 
            'From: ' . $imail . PHP_EOL . 
            'MIME-Version: 1.0'. PHP_EOL;
	
	$title = Yii::$app->request->post('comment') . ' ' . $_SERVER['HTTP_HOST'];

  if (!$imail) { 
// сообщение не отправилось
    $thisfile = pathinfo($_SERVER['PHP_SELF']); ?>

      <title>Ошибка отправки</title>
    </head>
    <body>
      <div style="width:980px;max-width:100%;margin:0 auto;text-align:center;">
        <h1> Ошибка отправки! </h1> 
        <h2>Email не задан, некуда отправить заявку</h2>

        Вверху файла <strong><?= $thisfile['basename'] ?></strong> найдите строку <strong>$imail=""</strong> и впишите ваш email в кавычках<br/>
        пример: <strong>$imail="<b>email@mail.ru</b>"</strong>
        <br/>
        <br/>

        <h2>Содержимое текущей заявки:</h2>
        <div class="mail"><?= (preg_replace("/\n/i", "<br>", $message)) ?></div>
      </div>
      <style>
        html{background-color: #EAC5C5;} b{color:#f00;}
        .mail{display: inline-block; margin: 0 auto; text-align: left; border: 3px solid #fff9; padding: 10px 25px;}
    h2{margin-bottom: 10px;}
      </style>
    </body>
    </html>

  <?php die; }

  if (mail($imail, $title, $message, $header) == 1) {
//Успешная заявка 
  ?> 

    <title>Спасибо за заявку!</title></head><body>
      <div class="outer-wrap" style="top: 40%;">
        <div class="container">
          <p id="info" ><?=$client . ' ' . $tiny_text;?></p>
        </div>
       </div>
    <style>
      html{
      	background-image: linear-gradient(to right, #2d46c4 0%, #e9541a 100%);
      	color: #fff;
      	font-weight: bold;
      }
      #info::first-letter{text-transform: uppercase;}
      #info{font-size: 1.4em!important; color:#fff;}
    </style> 

  <?php } else {
// Ошибка отправки ф-цией mail() 
  ?>

    <title>Ошибка отправки!</title></head><body>
      <div class="outer-wrap">
        <div class="container">
          <p id="info">Ошибка отправки заказа!<br/><span>Если вы видите это сообщение при попытке оформить заказ - свяжитесь с нами, для уточнения статуса заказа.</span><br /><br /><?php Html::a('На главную', ['/site/index']); ?></p>
        </div>
      </div>
    <style>
      html{background-image: linear-gradient(to top, #EAC5C5 0%, #FFF 50%, #EAC5C5 100%); background-color: #EAC5C5;}
    </style>

  <?php }

} else {
// Не указан обязательный парамерт отправки (напр. телефон) 
?>

  <title>Ошибка оформления заказа!</title></head><body>
    <div class="outer-wrap">
      <div class="container">
        <p id="info">Ошибка оформления заказа!<br/><span>Скорее всего, вы просто открыли эту страницу в браузере, вернитесь на главную и попробуйте сделать заказ.</span><br /><br /><?php Html::a('На главную', ['/site/index']); ?></p>
      </div>
    </div>
  <style>
    html{background-image: linear-gradient(to top, #F0E7E7 0%, #FFF 50%, #F0E7E7 100%); background-color: #FFE4E4;}
  </style>
<?php } ?>
<!-- метрика, аналитика -->
<?=$kod_kod?>

<style>
  #info {font-size: 1em; vertical-align: middle;}
  #info span {color: gray; font-size:0.8em;}
  .container{width: 95%;}
  body{margin: 0;}
  .container{margin: 0px auto; text-align: center; display: block; bottom: 0%; left: 0%;}
  .outer-wrap{top: 40%; position: absolute; width:100%;}
  @media (min-width: 1920px){body{font-size:24px;}}
  @media (max-width: 1920px){body{font-size:22px;}}
  @media (max-width: 1366px){body{font-size:20px;}}
  @media (max-width: 1024px){body{font-size:18px;}}
</style>

</body>
</body>
