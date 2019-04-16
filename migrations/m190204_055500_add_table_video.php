<?php

use yii\db\Migration;

/**
 * Class m190204_055500_add_table_video
 */
class m190204_055500_add_table_video extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('video', [
			'video_id' => $this->primaryKey(),
			'title' => $this->string(),
			'link' => $this->string(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('video');
    }

}
