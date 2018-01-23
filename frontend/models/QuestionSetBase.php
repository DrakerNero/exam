<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "question_set".
 *
 * @property integer $id
 * @property string $subject_id
 * @property string $name
 * @property string $explanation
 * @property string $question_type
 * @property integer $from
 * @property integer $to
 * @property integer $total_time
 * @property integer $total_score
 * @property string $status
 * @property string $created
 * @property string $updated
 */
class QuestionSetBase extends \yii\db\ActiveRecord {

  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'question_set';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
//        [['question_type'], 'required'],
        [['explanation'], 'string'],
        [['from', 'to', 'total_time', 'total_score', 'select_question_type', 'total_module', 'multi_select_choice', 'status'], 'integer'],
        [['created_at', 'updated_at'], 'safe'],
        [['subject_id'], 'string', 'max' => 15],
        [['name'], 'string', 'max' => 150],
        [['question_type'], 'string', 'max' => 2]
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
        'id' => 'ID',
        'subject_id' => 'Subject ID',
        'name' => 'Name',
        'explanation' => 'Explanation',
        'question_type' => 'Question Type',
        'total_module' => 'Total Module',
        'multi_select_choice' => 'Multi Select Choice',
        'from' => 'From',
        'to' => 'To',
        'total_time' => 'Total Time',
        'total_score' => 'Total Score',
        'select_question_type' => 'Select Question Type',
        'status' => 'Status',
        'created' => 'Created',
        'updated' => 'Updated',
    ];
  }

}
