<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $question_topic
 * @property string $question
 * @property integer $choice_type
 * @property string $choices
 * @property string $answer
 * @property string $answer_detail
 * @property integer $mp3
 * @property integer $png
 * @property integer $txt
 * @property string $updated
 */
class Question extends \yii\db\ActiveRecord {

  /**
   * @inheritdoc
   */
  public $choice_1;
  public $choice_2;
  public $choice_3;
  public $choice_4;
  public $choice_5;
  public $choice_6;
  public $choice_7;
  public $choice_8;
  public $choice_9;
  public $choice_10;
  public $choice_11;
  public $choice_12;
  public $choice_13;
  public $choice_14;
  public $choice_15;
  //
  public $answer_1;
  public $answer_2;
  public $answer_3;
  public $answer_4;
  public $answer_5;
  public $answer_6;
  public $answer_7;
  public $answer_8;
  public $answer_9;
  public $answer_10;
  public $answer_11;
  public $answer_12;
  public $answer_13;
  public $answer_14;
  public $answer_15;

  public static function tableName() {
    return 'question';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
        [['id', 'question', 'choices', 'answer', 'updated_at', 'part'], 'required'],
        [['id', 'question_topic', 'mp3', 'png', 'txt', 'max_select_choice', 'type_question', 'part'], 'integer'],
        [['question', 'choices', 'answer_detail', 'answers', 'answer_score'], 'string'],
        [[
        'choice_1', 'answer_1',
        'choice_2', 'answer_2',
        'choice_3', 'answer_3',
        'choice_4', 'answer_4',
        'choice_5', 'answer_5',
        'choice_6', 'answer_6',
        'choice_7', 'answer_7',
        'choice_8', 'answer_8',
        'choice_9', 'answer_9',
        'choice_10', 'answer_10',
        'choice_11', 'answer_11',
        'choice_12', 'answer_12',
        'choice_13', 'answer_13',
        'choice_14', 'answer_14',
        'choice_15', 'answer_15',
            ], 'string'],
        [['updated_at'], 'safe'],
        [['answer'], 'string', 'max' => 10]
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
        'id' => 'ID',
        'question_topic' => 'Question Topic',
        'question' => 'Question',
        'choices' => 'Choices',
        'answer' => 'Answer',
        'answer_detail' => 'Answer Detail',
        'mp3' => 'Mp3',
        'png' => 'Png',
        'txt' => 'Txt',
        'part' => 'Part',
        'updated_at' => 'Updated',
    ];
  }

}