<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

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
  //
  public $tree_1;
  public $tree_2;
  public $tree_3;
  public $tree_4;
  public $tree_5;
  public $tree_6;
  public $tree_7;
  public $tree_8;
  public $tree_9;
  public $tree_10;
  public $tree_11;
  public $tree_12;
  public $tree_13;
  public $tree_14;
  public $tree_15;
//
  public $file_upload;

  public static function tableName() {
    return 'question';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
        [['id', 'question', 'choices', 'answer', 'updated_at', 'part', 'is_mission_tree'], 'required'],
        [['id', 'question_topic', 'mp3', 'png', 'txt', 'max_select_choice', 'type_question', 'part'], 'integer'],
        [['question', 'choices', 'answer_detail', 'answers', 'answer_score', 'mission_tree_questions'], 'string'],
        [[
        'choice_1', 'answer_1', 'tree_1',
        'choice_2', 'answer_2', 'tree_2',
        'choice_3', 'answer_3', 'tree_3',
        'choice_4', 'answer_4', 'tree_4',
        'choice_5', 'answer_5', 'tree_5',
        'choice_6', 'answer_6', 'tree_6',
        'choice_7', 'answer_7', 'tree_7',
        'choice_8', 'answer_8', 'tree_8',
        'choice_9', 'answer_9', 'tree_9',
        'choice_10', 'answer_10', 'tree_10',
        'choice_11', 'answer_11', 'tree_11',
        'choice_12', 'answer_12', 'tree_12',
        'choice_13', 'answer_13', 'tree_13',
        'choice_14', 'answer_14', 'tree_14',
        'choice_15', 'answer_15', 'tree_15',
            ], 'string'],
        [['updated_at'], 'safe'],
        [['answer'], 'string', 'max' => 10],
        [['file_upload'], 'file', 'extensions' => 'png', 'maxSize' => 1024 * 1024 * 2],
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
        'is_mission_tree' => 'Is Mission Tree',
        'mission_tree_questions' => 'Mission Tree Questions',
        'updated_at' => 'Updated',
    ];
  }

  public function uploadFile($attribute) {
    // get the uploaded file instance. for multiple file uploads
    // the following data will return an array (you may need to use
    // getInstances method)
    $image = UploadedFile::getInstance($this, $attribute);

    // if no image was uploaded abort the upload
    if (empty($image)) {
      return false;
    }

    // store the source file name
    $this->$attribute = $image->name;
    //$ext = end((explode(".", $image->name)));
    // generate a unique file name
    //$this->avatar = Yii::$app->security->generateRandomString() . ".{$ext}";
    // the uploaded image instance
    return $image;
  }

}
