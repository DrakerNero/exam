<?php

use yii\db\Migration;
use frontend\models\QuestionSet;

class m150916_080144_question_set extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%question_set}}', [
          'id' => $this->primaryKey(),
          'subject_id' => $this->integer(11),
          'name' => $this->string(255),
          'explanation' => $this->text(),
          'from' => $this->integer(11),
          'to' => $this->integer(11),
          'total_time' => $this->integer(3),
          'total_score' => $this->integer(3),
          'question_type' => $this->string(2),
          'status' => $this->smallInteger()->notNull()->defaultValue(QuestionSet::STATUS_ACTIVE),
          'created_at' => $this->integer(11),
          'updated_at' => $this->integer(11),
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%question_set}}');
    }
}
