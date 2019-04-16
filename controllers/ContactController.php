<?php

namespace app\controllers;

use Yii;
use app\models\Contact;
use app\models\ContactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use cadyrov\gii\Upload;
use yii\filters\AccessControl;
use moonland\phpexcel\Excel;
use yii\db\Query;
use yii\web\UploadedFile;

class ContactController extends Controller
{
    const RES_TRUE = 10;
	const RES_FALSE = 20;
	const RES_NOONE = 30;

    private $error=[];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','delete','update','download','upload'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','delete','update','download','upload'],
                        'allow' => true,
                        'roles' => ['settings'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
		$model = new Contact();
        $upload = new Upload();
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'upload' => $upload,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->save();
        }

        return $this->redirect(['index']);
    }

    public function actionUpdate()
    {
        $model = Contact::find()->one();
		$model = ($model == null ? new Contact() : $model);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->save();
			return $this->redirect(['update']);
        }
		return $this->render('update', [
            'model' => $model,
        ]);

    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload()
    {
        $table = Contact::tableName();
		ob_end_clean();
		$query = new Query;
		$query->select('*')
			->from($table );
		$resarr=$query->all();

        
		return Excel::export([
            'format' => 'Xlsx',
			'asAttachment' => true,
            'fileName' => $table,
            'models' => $resarr,
            'columns' => ['contact_id', 'name', 'address', 'phone', 'email', ],
            'headers' => ['contact_id'  => 'contact_id', 'name'  => 'name', 'address'  => 'address', 'phone'  => 'phone', 'email'  => 'email', ],
        ]);
    }

    public function actionUpload()
    {
        set_time_limit(5000);
        $model = new Upload();
		$res = "";
        if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');

            $path = dirname(__DIR__).'/runtime/temp/';
            if (!file_exists($path) && !mkdir($path)) {
                return 'не удалось создать директорию';
            }
            if ($model->file && $model->validate()) {

                $fileName = 'upload_price_temp.xls';

                if (file_exists($path.$fileName)) {
                    unlink($path.$fileName);
                }
                $model->file->saveAs($path.$fileName);
                if (!file_exists($path.$fileName)) {
                    die('не удалось сохранить файл');
                }
				ob_end_clean();
                $data =Excel::import($path.$fileName,
                    ['setFirstRecordAsKeys' => true,
                    'setIndexSheetByName' => true,]);
                if (!is_array($data)) {
                    die('не удалось разобрать файл');
                }

                if (is_array($data) && count($data) > 0) {
                    foreach ($data as $n => $m) {
						if ($m != null && $this->issetParams($m) == self::RES_TRUE) {
							$res .= $this->updateRecord($m);
						} else {
							foreach($m as $k=>$v){
								$res .= $this->updateRecord($v);
							}
						}
					}
                } else {
					return print_r(serialize($data));
				}
            } else {
				return print_r(serialize($model->getErrors()));
			}
        } else {
			return 'is no post';
		}
        return $this->redirect(['index','message'=>serialize($res)]);
    }

    private function updateRecord($v){
		$res = "";
        if ($v != null && is_array($v)) {
            $isset = $this->issetParams($v);
            if ($isset == self::RES_TRUE) {
                $model = Contact::findOne($v['contact_id']);
                if ($model == null) {
                    $model = new Contact();
                }
                $model->setAttributes($v);
                if ($model->validate()) {
					                    $model->save();
                } else {
                    return (serialize($model->getErrors()));
                }

            } elseif ($isset == self::RES_FALSE) {
                return ('Не все параметры переданы');
            }
        }
		return $res;
	}

	private function issetParams(array $array){
		$this->error = [];
		$nameArr = ['contact_id', 'name', 'address', 'phone', 'email', ];
		$result = self::RES_FALSE;
		$all = self::RES_FALSE;
		$one = self::RES_TRUE;
		foreach ($nameArr as $name) {
			if (!isset($array[$name])) {
				$this->error[] = $name;
				$one = self::RES_FALSE;
			} else {
				$all = self::RES_TRUE;
			}
		}

		if ($all == self::RES_FALSE) {
			$result = self::RES_NOONE;
		} elseif ($one == self::RES_FALSE) {
			$result = self::RES_FALSE;
		} else {
			$result = self::RES_TRUE;
		}

		return $result;
	}
}
