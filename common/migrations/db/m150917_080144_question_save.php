<?php

use yii\db\Migration;
use frontend\models\QuestionSave;

class m150917_080144_question_save extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%question_save}}', [
          'id' => $this->primaryKey(),
          'question_set_id' => $this->integer(11),
          'user_id' => $this->string(255),
          'mode' => $this->string(255),
          'answer' => $this->text(),
          'elapse_time' => $this->integer(4),
          'score' => $this->integer(4),
          'status' => $this->smallInteger()->notNull()->defaultValue(QuestionSave::STATUS_ACTIVE),
          'created_at' => $this->integer(11),
          'updated_at' => $this->integer(11),
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%question_save}}');
    }
}
