<?php

use yii\db\Migration;


class m190205_033020_add_catalog extends Migration
{
    public function safeUp()
    {
		$this->createTable('category', [
			'category_id' => $this->primaryKey(),
			'name' => $this->string(),
			'description' => $this->text(),
			'sys_id' => $this->string(),
			'title' => $this->string(),
			'keyword' => $this->text(),
			'img' => $this->string(),
		]);
		
		$this->createTable('middle', [
			'middle_id' => $this->primaryKey(),
			'name' => $this->string(),
			'description' => $this->text(),
			'sys_id' => $this->string(),
			'title' => $this->string(),
			'keyword' => $this->text(),
			'category_id' => $this->integer(),
			'img' => $this->string(),
		]);
		
		$this->addForeignKey('middle_category_id_fk', 'middle', 'category_id', 'category', 'category_id', 'CASCADE');
		
		$this->createTable('subcategory', [
			'subcategory_id' => $this->primaryKey(),
			'name' => $this->string(),
			'description' => $this->text(),
			'sys_id' => $this->string(),
			'title' => $this->string(),
			'keyword' => $this->text(),
			'category_id' => $this->integer(),
			'middle_id' => $this->integer(),
			'img' => $this->string(),
		]);
		
		$this->addForeignKey('subcategory_category_id_fk', 'subcategory', 'category_id', 'category', 'category_id', 'CASCADE');
		
		$this->addForeignKey('subcategory_middle_id_fk', 'subcategory', 'middle_id', 'middle', 'middle_id', 'CASCADE');
		
		$this->createTable('manufacture', [
			'manufacture_id' => $this->primaryKey(),
			'name' => $this->string(),
			'description' => $this->text(),
			'sys_id' => $this->string(),
			'title' => $this->string(),
			'keyword' => $this->text(),
		]);
		
		$this->createTable('catalog', [
			'goods_id' => $this->primaryKey(),
			'name' => $this->string(),
			'description' => $this->text(),
			'price' => $this->decimal(10,2),
			'sys_id' => $this->string(),
			'title' => $this->string(),
			'keyword' => $this->text(),
			'category_id' => $this->integer(),
			'middle_id' => $this->integer(),
			'subcategory_id' => $this->integer(),
			'manufacture_id' => $this->integer(),
			'status_id' => $this->integer(),
			'i1' => $this->integer(),
			'i2' => $this->integer(),
			'i3' => $this->integer(),
			'd1' => $this->decimal(10,2),
			'd2' => $this->decimal(10,2),
			'd3' => $this->decimal(10,2),
			'subtype1' => $this->integer(),
			'subtype2' => $this->integer(),
			'subtype3' => $this->integer(),
			'vch1' => $this->string(32),
			'vch2' => $this->string(32),
			'img' => $this->string(),
		]);
		
		$this->createIndex('idx-catalog-vch1', 'catalog', 'vch1'); 
		$this->createIndex('idx-catalog-vch2', 'catalog', 'vch2'); 
		$this->addForeignKey('catalog_category_id_fk', 'catalog', 'category_id', 'category', 'category_id', 'CASCADE');
		$this->addForeignKey('catalog_middle_id_fk', 'catalog', 'middle_id', 'middle', 'middle_id', 'CASCADE');
		$this->addForeignKey('catalog_subcategory_id_fk', 'catalog', 'subcategory_id', 'subcategory', 'subcategory_id', 'CASCADE');
		$this->addForeignKey('catalog_manufacture_id_fk', 'catalog', 'manufacture_id', 'manufacture', 'manufacture_id', 'CASCADE');
		
		$this->createTable('filters', [
			'filter_id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'param' => $this->string()->notNull(),
			'category_id' => $this->integer(),
			'middle_id' => $this->integer(),
			'subcategory_id'  => $this->integer(),
			'sort' => $this->integer(),
		]);
		
		$this->createIndex('idx-filters-category_id', 'filters', 'category_id');
		
		$this->addForeignKey('filters_category_id_fk', 'filters', 'category_id', 'category', 'category_id', 'CASCADE');
		
		$this->createIndex('idx-filters-middle_id', 'filters', 'middle_id');
		
		$this->addForeignKey('filters_middle_id_fk', 'filters', 'middle_id', 'middle', 'middle_id', 'CASCADE');
		
		$this->createIndex('idx-filters-subcategory_id', 'filters', 'subcategory_id');
		
		$this->addForeignKey('filters_subcategory_id_fk', 'filters', 'subcategory_id', 'subcategory', 'subcategory_id', 'CASCADE');
    }

   
    public function safeDown()
    {
		$this->dropForeignKey('filters_subcategory_id_fk', 'filters');
		$this->dropIndex('idx-filters-subcategory_id', 'filters');
		$this->dropForeignKey('filters_middle_id_fk', 'filters');
		$this->dropIndex('idx-filters-middle_id', 'filters');
		$this->dropForeignKey('filters_category_id_fk', 'filters');
		$this->dropIndex('idx-filters-category_id', 'filters');
		$this->dropTable('filters');
		
		$this->dropForeignKey('catalog_manufacture_id_fk', 'catalog');
		$this->dropForeignKey('catalog_subcategory_id_fk', 'catalog');
		$this->dropForeignKey('catalog_middle_id_fk', 'catalog');
		$this->dropForeignKey('catalog_category_id_fk', 'catalog');
		$this->dropIndex('idx-catalog-vch2', 'catalog');
		$this->dropIndex('idx-catalog-vch1', 'catalog');
		$this->dropTable('catalog');
		
		$this->dropTable('manufacture');
		
		$this->dropForeignKey('subcategory_middle_id_fk', 'subcategory');
		$this->dropForeignKey('subcategory_category_id_fk', 'subcategory');
		$this->dropTable('subcategory');
		
		$this->dropForeignKey('middle_category_id_fk', 'middle');
		$this->dropTable('middle');
		
		$this->dropTable('category');
    }


}
