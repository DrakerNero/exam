<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "question_save".
 *
 * @property integer $id
 * @property integer $question_set_id
 * @property string $user_id
 * @property string $mode
 * @property string $answer
 * @property integer $elapse_time
 * @property integer $status

 * @property integer $score
 * @property integer $created_at
 * @property integer $updated_at
 */
class QuestionSaveBase extends \yii\db\ActiveRecord {

  /**
   * @inheritdoc
   */
//  public $questionSet;

  public static function tableName() {
    return 'question_save';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
        [['question_set_id', 'elapse_time', 'status', 'created_at', 'updated_at', 'present_question', 'multi_select_choice', 'score'], 'integer'],
        [['answer', 'module_part', 'user_id', 'mode'], 'string'],
//        [['user_id', 'mode'], 'string', 'max' => 255],
    ];
  }

  /**
   * @inheritdoc
   */ 
  public function attributeLabels() {
    return [
        'id' => 'ID',
        'question_set_id' => 'Question Set ID',
        'present_question' => 'Present Question',
        'module_part' => 'Module Part',
        'user_id' => 'User ID',
        'mode' => 'Mode',
        'answer' => 'Answer',
        'score' => 'Score',
        'elapse_time' => 'Elapse Time',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'multi_select_choice' => 'multi_select_choice',
    ];
  }

}
