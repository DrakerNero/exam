<?php

use yii\db\Migration;

class m150916_080157_subject extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%subject}}', [
          'id' => $this->primaryKey(),
          'exam_class' => $this->string(255),
          'exam_subclass' => $this->string(255),
          'status' => $this->integer(11),
      ], $tableOptions);
    }

    public function down()
    {
      $this->dropTable('{{%subject}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
