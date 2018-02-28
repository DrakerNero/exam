<?php

namespace frontend\models;

use frontend\models\QuestionSaveBase;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "question_save".
 *
 * @property integer $id
 * @property string $question_set_id
 * @property integer $user_id
 * @property string $mode
 * @property string $answer
 * @property integer $elapse_time
 * @property string $status
 * @property string $updated
 */
class QuestionSave extends QuestionSaveBase {

  const STATUS_DELETED = 0;
  const STATUS_DOING = 1;
  const STATUS_PAUSED = 2;
  const STATUS_DONE = 3;

  /**
   * @inheritdoc
   */
  public function behaviors() {
    return [
        TimestampBehavior::className(),
    ];
  }

  public function LoadQuestionSave($questionSetID, $multiSelectChoice) {
    $userId = Yii::$app->user->identity->id;
    $model = QuestionSave::find()->where(['user_id' => $userId, 'question_set_id' => $questionSetID, 'status' => [1, 2, 3]])->one();
    if (empty($model->id) && isset($model->id)) {
      $model2 = new QuestionSave();
      $model2->user_id = '' . $userId;
      $model2->question_set_id = $questionSetID;
      $model2->status = 1;
      $model2->multi_select_choice = $multiSelectChoice;
      $model2->present_question = 1;
      $model2->save();
      echo "<pre>";
      print_r($model);
//      if (!$model->save()) {
//        print_r($model->getErrors());
//        exit();
//      }
    } else {
      $model->elapse_time = $model->updated_at - $model->created_at;
      $model->created_at = time() - $model->elapse_time;
      $model->save();
    }
    return $model;
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getQuestionSet() {
    return $this->hasOne(QuestionSet::className(), ['id' => 'question_set_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUser() {
    return $this->hasOne(User::className(), ['id' => 'user_id']);
  }

  public function getUserProfile() {
    return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
  }

}
