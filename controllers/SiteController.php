<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Catalog;
use yii\db\Query;
use app\models\Filters;
use app\models\Manufacture;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;
use app\models\Middle;
use app\models\Category;
use app\models\Certificate;
use app\models\Site;
class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
		$this->layout = 'site';
		$manufacture = Manufacture::find()->asArray()->all();
		$category = Category::find()->where(['type' => 20])->orderBy('category_id')->asArray()->all();
		return $this->render('index', ['manufacture' => $manufacture, 'category' => $category]);
    }


	public function actionServices()
	{
		$this->layout = 'site';
		$manufacture_id = Yii::$app->request->get('manufacture_id');
		$category_id = Yii::$app->request->get('category_id');
		$query = Category::find()->asArray()->orderBy('category_id');
		if ($manufacture_id != null or $category_id != null) {
			$query = new Query();
			$query->select('cat.*')->from('catalog cat');
			if ($manufacture_id != null) {
				$query->andWhere(['manufacture_id' => $manufacture_id]);
			}
			
			if ($category_id != null) {
				$query->andWhere(['category_id' => $category_id]);
			}
			
			$query->orderBy('sort');
		}
		
		if ($manufacture_id != null && $category_id == null) {
			$query = new Query;
			$query->select('c.*')->from('category c')->orderBy('category_id');
		}
		
		return $this->render('services', ['catalog' => $query->all(), 'middle_img' => ArrayHelper::map(Middle::find()->all(),'middle_id', 'img'), 'category_img' => ArrayHelper::map(Category::find()->all(), 'category_id', 'img')]);
	}

	public function actionSingle($id, $alias = '')
	{
		$model = Catalog::findOne($id);
        if ($model == null) {
            throw new HttpException(404, 'Not found');
		}
		if (Yii::$app->request->url != $model->url) {
            $this->redirect($model->url, true, 301);
		}

		$manufacture_id = Yii::$app->request->get('manufacture_id');
		$manufacture = Manufacture::findOne($manufacture_id);
		$this->layout = 'site';
		$query = new Query();
		$query->select('cat.*, c.name as catname');
		$query->from('catalog cat, category c');
		$query->where(['goods_id' => Yii::$app->request->get('id')]);
		$query->andWhere('cat.category_id = c.category_id');

		if ($manufacture_id != null) {
			return $this->render('single', ['goods' => $manufacture]);
		}
		return $this->render('single', ['goods' => $query->one(), 'middle_img' => ArrayHelper::map(Middle::find()->all(),'middle_id', 'img'), 'category_img' => ArrayHelper::map(Category::find()->all(), 'category_id', 'img')]);
	}

	public function actionFilter()
	{
		$category_id = Yii::$app->request->post('category_id');
		$query = new Query;
		$query->select('f.*');
		$query->from('filters f');
		$query->where(['category_id' => $category_id]);
		$query->andWhere(['not',['type' => null]]);
		$query->andWhere(['not',['name2' => null]]);
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $query->all();
	}

	public function actionCategoryfilter()
	{
		$category_id = Yii::$app->request->post('category_id');
		$query = new Query;
		$query->select('mid.*');
		$query->from('middle mid');
		$query->where(['category_id' => $category_id]);
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $query->all();
	}
	
	public function actionOrderform()
	{
		$goods_id = Yii::$app->request->post('goods_id');
		$query = new Query;
		$query->select('cat.name as tovar, c.name as category, m.name as manufacture, mid.name as middle');
		$query->from('catalog cat, category c, manufacture m, middle mid');
		$query->where(['goods_id' => $goods_id]);
		$query->andWhere('cat.category_id = c.category_id');
		$query->andWhere('cat.manufacture_id = m.manufacture_id');
		$query->andWhere('c.category_id = mid.category_id');
		$query->andWhere('cat.middle_id = mid.middle_id');
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $query->all();
	}
	
	public function actionConfidence(){
		$this->layout = "docs";
		$ordernum = "1";
		$orderdate = "01.01.2019";
		$ceotvar = "Забировым Дмитрием Ринатовичем";
		$org = "ИП Забиров Дмитрий Ринатович";
		$ceo = "Забиров Дмитрий Ринатович";
        return $this->render('confidence', [
			'ceotvar' => $ceotvar,
			'ceo' => $ceo,
			'organisation' => $org,
			'ordernum' => $ordernum,
			'orderdate' => $orderdate
		]);
    }

	public function actionFormsubmit()
	{
		return $this->renderAjax('spasibo');
	}

	public function actionRenderhomepage()
    {
        return $this->renderAjax('/site/main/homepage');
    }

	public function actionRenderseparator()
	{
		return $this->renderAjax('/site/main/separator');
	}

	public function actionRendercases()
	{
		return $this->renderAjax('/site/main/cases');
	}

	public function actionRendertarifs()
	{
		return $this->renderAjax('/site/main/tarifs');
	}

	public function actionRenderfaq()
	{
		return $this->renderAjax('/site/main/faq');
	}
	
	public function actionRendercertificate()
	{
		$certificate = Certificate::find()->asArray()->all();
		return $this->renderAjax('/site/main/certificate', ['certificate' => $certificate]);
	}

	public function actionRendervideo()
	{
		return $this->renderAjax('/site/main/video');
	}

	public function actionRenderproductlist()
	{
		$manufacture_id = Yii::$app->request->post('manufacture_id');
		$category_id = Yii::$app->request->post('category_id');
		$middle_id = Yii::$app->request->post('middle_id');
		$price_from = Yii::$app->request->post('price_from');
		$price_to = Yii::$app->request->post('price_to');
		$search = Yii::$app->request->post('search');
		$i1 = Yii::$app->request->post('i1');
		$i2 = Yii::$app->request->post('i2');
		$query = new Query();
		$query->select('cat.price, cat.name, cat.img, cat.goods_id, c.name as catname, cat.category_id, cat.middle_id, cat.manufacture_id');
		$query->from('catalog cat, category c');
		$query->andWhere('cat.category_id = c.category_id');
		if ($category_id != null) {
			$query->andWhere('cat.category_id =:cat', ['cat' => $category_id]);
			
		}
		
		if ($middle_id != null) {
			$query->andWhere('cat.middle_id =:mid', ['mid' => $middle_id]);
		}
		if ($price_from != null) {
			$query->andWhere('cat.price >=:price_from', ['price_from' => $price_from]);
		}
		if ($price_to != null) {
			$query->andWhere('cat.price <=:price_to', ['price_to' => $price_to]);
		}
		if ($search != null) {
			$newsearch = '%';
			foreach(explode(' ', $search) as $r) {
				$newsearch .= mb_strtolower($r).'%';
			}
			$query->andWhere('lower(cat.name) like :search', ['search' => $newsearch]);
		}
		if ($i1 != null && is_numeric($i1)) {
			$query->andWhere('cat.i1 >=:i1', ['i1' => $i1]);
		}
		if ($i2 != null && is_numeric($i2)) {
			$query->andWhere('cat.i2 >=:i2', ['i2' => $i2]);
		}
		$query->orderBy('sort');
		if ($manufacture_id != null) {
			$query->andWhere(['manufacture_id' => $manufacture_id]);
		}
		
		if ($category_id == null && $middle_id == null && $search == null) {
			$query = new Query;
			$query->select('c.*')->from('category c')->orderBy('category_id');
		}
		
		
		return $this->renderAjax('/site/main/product', ['catalog' => $query->all(), 'middle_img' => ArrayHelper::map(Middle::find()->all(),'middle_id', 'img'), 'category_img' => ArrayHelper::map(Category::find()->all(), 'category_id', 'img')]);
	}




	public function beforeAction($action)
	{
		if (in_array($action->id, ['renderproductlist', 'formsubmit', 'filter', 'ot', 'categoryfilter', 'orderform'])) {
			$this->enableCsrfValidation = false;
		}
		return parent::beforeAction($action);
	}

}
