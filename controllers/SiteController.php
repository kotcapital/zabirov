<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
        return $this->render('index');
    }

	
	public function actionServices()
	{
		$this->layout = 'site';
		return $this->render('services');
	}
	
	public function actionSingle()
	{
		$this->layout = 'site';
		return $this->render('single');
	}
	
	public function actionFormsubmit()
	{
		$this->layout = 'main';
		return $this->render('spasibo');
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
	
	public function actionRendervideo()
	{
		return $this->renderAjax('/site/main/video');
	}
	
	public function actionRenderproductlist()
	{
		return $this->renderAjax('/site/main/product');
	}
	
	public function actionRenderproductlist2()
	{
		return $this->renderAjax('/site/main/product2');
	}
}
