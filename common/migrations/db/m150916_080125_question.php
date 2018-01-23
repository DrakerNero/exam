<?php

use yii\db\Migration;

class m150916_080125_question extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%question}}', [
          'id' => $this->primaryKey(),
          'question_topic' => $this->integer(11),
          'question' => $this->text(),
          'type_question' => $this->integer(2),
          'choices' => $this->text(),
          'answer' => $this->text(),
          'answer_detail' => $this->text(),
          'mp3' => $this->binary(),
          'png' => $this->binary(),
          'txt' => $this->binary(),
          'updated_at' => $this->integer(11),
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%question}}');
    }
}
