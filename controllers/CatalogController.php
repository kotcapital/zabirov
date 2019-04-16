<?php

namespace app\controllers;

use Yii;
use app\models\Catalog;
use app\models\CatalogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use cadyrov\gii\Upload;
use yii\filters\AccessControl;
use moonland\phpexcel\Excel;
use yii\db\Query;
use yii\web\UploadedFile;

class CatalogController extends Controller
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

	
	public function actionRenderfilter()
    {
		
        return $this->renderAjax('/site/filter');
    }
	
    public function actionIndex()
    {
		$model = new Catalog();
        $upload = new Upload();
        $searchModel = new CatalogSearch();
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
        $model = new Catalog();

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
		$catalog = Catalog::findOne($id);
		$file= '/var/www/html/basic/web/img/catalog/'. $id . '.' . $catalog['img'];
		if ($catalog['img'] != null) {
			unlink($file);
		}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Catalog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload()
    {
        $table = Catalog::tableName();
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
            'columns' => ['goods_id', 'name', 'description', 'price', 'sys_id', 'title', 'keyword', 'category_id', 'middle_id', 'subcategory_id', 'manufacture_id', 'status_id', 'i1', 'i2', 'i3', 'd1', 'd2', 'd3', 'subtype1', 'subtype2', 'subtype3', 'vch1', 'vch2', 'vch3', 'vch4', 'img', 'type', 'sort'],
            'headers' => ['goods_id'  => 'goods_id', 'name'  => 'name', 'description'  => 'description', 'price'  => 'price', 'sys_id'  => 'sys_id', 'title'  => 'title', 'keyword'  => 'keyword', 'category_id'  => 'category_id', 'middle_id'  => 'middle_id', 'subcategory_id'  => 'subcategory_id', 'manufacture_id'  => 'manufacture_id', 'status_id'  => 'status_id', 'i1'  => 'i1', 'i2'  => 'i2', 'i3'  => 'i3', 'd1'  => 'd1', 'd2'  => 'd2', 'd3'  => 'd3', 'subtype1'  => 'subtype1', 'subtype2'  => 'subtype2', 'subtype3'  => 'subtype3', 'vch1'  => 'vch1', 'vch2'  => 'vch2', 'vch3'  => 'vch3', 'vch4'  => 'vch4', 'img' => 'img', 'type' => 'type', 'sort' => 'sort'],
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
							$res = $this->updateRecord($m);
						} else {
							foreach($m as $k=>$v){
								 $this->updateRecord($v);
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
	
	
	function compressImage($source_url, $destination_url, $quality) 
	{
		$info = getimagesize($source_url);
		if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);

		imagejpeg($image, $destination_url, $quality);
		return $image;
	}
	
	
	
	public function actionUploadimg()
    {
        $model = new Upload();
		$res = "";
		$catalog = Catalog::findOne(Yii::$app->request->post('goods_id'));
        if ($catalog != null) {
			$model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');
			$model->file->saveAs('/var/www/html/basic/web/img/catalog/' . $catalog->goods_id . '.' . $model->file->extension);
			
			$catalog->img = $model->file->extension;
			$catalog->save();
			
        }
        return $this->redirect(['index']);
    }
	
	
	
	
	
	
    private function updateRecord($v){
		$res = "";
        if ($v != null && is_array($v)) {
            $isset = $this->issetParams($v);
            if ($isset == self::RES_TRUE) {
                $model = Catalog::findOne($v['goods_id']);
                if ($model == null) {
                    $model = new Catalog();
                }
				if (!$v['goods_id']) {
					unset($v['goods_id']);
				};
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
		$nameArr = ['name', 'description'];
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
