<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class Catalog extends \yii\db\ActiveRecord
{
	const TYPE_PRODUCT = 1;
	const TYPE_SERVICE = 2;

	const STATUS_AVAILABLE = 10;
	const STATUS_NOT_AVAILABLE = 900;
	
    public static function tableName()
    {
        return 'catalog';
    }
	

    public static function getTypeArray()
    {
         return [
            self::TYPE_PRODUCT => 'Товар',
            self::TYPE_SERVICE => 'Услуга',
        ];
    }
	
	public static function getStatusArray()
    {
        return [
            self::STATUS_AVAILABLE => 'В наличии',
            self::STATUS_NOT_AVAILABLE => 'Нет в наличии',
        ];
    }
	
	public static function getMapParameters()
	{
		return [
			'i1' => 'i1',
			'i2' => 'i2',
			'i3' => 'i3',
			'd1' => 'd1',
			'd2' => 'd2',
			'd3' => 'd3',
			'vch1' => 'vch1',
			'vch2' => 'vch2',
			'vch3' => 'vch3',
			'vch4' => 'vch4',
        ];
	}
	
	
	public static function getStatusById($id)
    {
        return ArrayHelper::getValue(self::getStatusArray(), $id);
    }
	
	
    public function rules()
    {
        return [
            [['description', 'keyword', 'img'], 'string'],
            [['price', 'd1', 'd2', 'd3'], 'number'],
            [['category_id', 'middle_id', 'subcategory_id', 'manufacture_id', 'status_id', 'i1', 'i2', 'i3', 'subtype1', 'subtype2', 'subtype3'], 'default', 'value' => null],
            [['goods_id', 'category_id', 'middle_id', 'subcategory_id', 'manufacture_id', 'status_id', 'i1', 'i2', 'i3', 'subtype1', 'subtype2', 'subtype3','type', 'sort'], 'integer'],
            [['name', 'sys_id', 'title'], 'string', 'max' => 255],
            [['vch1', 'vch2', 'vch3', 'vch4'], 'string', 'max' => 32],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['manufacture_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacture::className(), 'targetAttribute' => ['manufacture_id' => 'manufacture_id']],
            [['middle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Middle::className(), 'targetAttribute' => ['middle_id' => 'middle_id']],
            [['subcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcategory_id' => 'subcategory_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'goods_id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'price' => 'Цена',
            'sys_id' => 'Sys ID',
            'title' => 'Заголовок',
            'keyword' => 'Ключевые слова',
            'category_id' => 'Категория',
            'middle_id' => 'Подкатегория',
            'subcategory_id' => 'Подподкатегория',
            'manufacture_id' => 'Производитель',
            'status_id' => 'Статус',
            'i1' => 'Ширина',
            'i2' => 'Высота',
            'i3' => 'I3',
            'd1' => 'D1',
            'd2' => 'D2',
            'd3' => 'D3',
            'subtype1' => 'Подтип1',
            'subtype2' => 'Подтип2',
            'subtype3' => 'Подтип3',
            'vch1' => 'vch1',
            'vch2' => 'vch2',
            'vch3' => 'vch3',
            'vch4' => 'vch4',
			'img' => 'Изображение',
			'type' => 'Тип',
			'sort' => 'Сортировка',
        ];
    }
	
	public function getAlias($alias)
	{
		$alf = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'y',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => '',    'ы' => 'y',   'ъ' => '',
			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

			'А' => 'a',   'Б' => 'b',   'В' => 'v',
			'Г' => 'g',   'Д' => 'd',   'Е' => 'e',
			'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',
			'И' => 'i',   'Й' => 'y',   'К' => 'k',
			'Л' => 'l',   'М' => 'm',   'Н' => 'n',
			'О' => 'o',   'П' => 'p',   'Р' => 'r',
			'С' => 's',   'Т' => 't',   'У' => 'u',
			'Ф' => 'f',   'Х' => 'h',   'Ц' => 'c',
			'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',
			'Ь' => '',    'Ы' => 'y',   'Ъ' => '',
			'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya',
		);
		$alias = strtr($alias, $alf);
		$alias = mb_strtolower($alias);	
		$alias = mb_ereg_replace('[^-0-9a-z]', '-', $alias);
		$alias = mb_ereg_replace('[-]+', '-', $alias);
		$alias = trim($alias, '-');			
		return $alias;
	}
	
	
	
	public function getUrl() 
	{
        return $url = Url::to(['/site/single/' . $this->goods_id . '/' . self::getAlias($this->name) . '']);
    }
	
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    public function getManufacture()
    {
        return $this->hasOne(Manufacture::className(), ['manufacture_id' => 'manufacture_id']);
    }

    public function getMiddle()
    {
        return $this->hasOne(Middle::className(), ['middle_id' => 'middle_id']);
    }

    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['subcategory_id' => 'subcategory_id']);
    }

	public function getImagePath($middleArray, $categoryArray) {
		if ($this->img != null) {
			$res = 'img/catalog/' . $this->goods_id . '.' . $this->img;
			if (file_exists($res)) {
				return $res;
			}
		}
		if ($this->img == null && $this->middle_id != null) {
			$res = 'img/middle/' . $this->middle_id . '.' . ArrayHelper::getValue($middleArray, $this->middle_id);
			if (file_exists($res)) {
				return $res;
			}
		}else{
			$res = 'img/category/' . $this->category_id . '.' . ArrayHelper::getValue($categoryArray, $this->category_id);
			if (file_exists($res)) {
				return $res;
			}
		}
		
	}
}
