<?php

namespace app\controllers;

use Yii;
use app\models\Cases;
use app\models\CasesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use cadyrov\gii\Upload;
use yii\filters\AccessControl;
use moonland\phpexcel\Excel;
use yii\db\Query;
use yii\web\UploadedFile;

class CasesController extends Controller
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
                'only' => ['index', 'view', 'create', 'delete', 'update', 'download', 'upload', 'uploadimg'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'delete', 'update', 'download', 'upload', 'uploadimg'],
                        'allow' => true,
                        'roles' => ['settings'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
		$model = new Cases();
        $upload = new Upload();
        $searchModel = new CasesSearch();
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
        $model = new Cases();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			            $model->save();
        }

        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			            $model->save();
			return $this->redirect(['index']);
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
        if (($model = Cases::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload()
    {
        $table = Cases::tableName();
		ob_end_clean();
		$query=new Query;
		$query->select('*')
		->from($table );
		$resarr=$query->all();

        
		return Excel::export([
            'format' => 'Xlsx',
			'asAttachment' => true,
            'fileName' => $table,
            'models' => $resarr,
            'columns' => ['cases_id', 'title', 'img', 'before', 'after', 'description', 'difference', ],
            'headers' => ['cases_id'  => 'cases_id', 'title'  => 'title', 'img'  => 'img', 'before'  => 'before', 'after'  => 'after', 'description'  => 'description', 'difference'  => 'difference', ],
        ]);
    }

    public function actionUpload()
    {
        set_time_limit(5000);
        $model = new Upload();
		$res="";
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
	
	
	public function actionUploadimg()
    {
        $model = new Upload();
		$res = "";
		$cases = Cases::findOne(Yii::$app->request->post('cases_id'));
        if ($cases != null) {
			$model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');
			$model->file->saveAs('/var/www/html/basic/web/img/cases/' . $cases->cases_id . '.' . $model->file->extension);

			$cases->img = $model->file->extension;
			$cases->save();
        }
        return $this->redirect(['index']);
    }

    private function updateRecord($v){
		$res = "";
        if ($v != null && is_array($v)) {
            $isset = $this->issetParams($v);
            if ($isset == self::RES_TRUE) {
                $model = Cases::findOne($v['cases_id']);
                if ($model == null) {
                    $model = new Cases();
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
		$nameArr = ['cases_id', 'title', 'img', 'before', 'after', 'description', 'difference', ];
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
