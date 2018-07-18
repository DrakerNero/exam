<?php

namespace frontend\models;

use Yii;

class QuestionHistory extends \yii\db\ActiveRecord {

  public function Gen_Graph_Question($models) {
    $graph_arr[] = array('ครั้งที่', 'เวลา', 'คะแนน');
    $i = sizeof($models);
    foreach ($models as $model) {
      $graph_arr[] = array('ครั้งที่' . $i, $model->elapse_time, $model->score);
      $i--;
    }
    return $graph_arr;
  }

  public function Gen_Counr_Number($models) {
    $score_arr = [];
    $question_pord = 0;
    foreach ($models as $model) {
      $score_arr[] = $model->score;
      if ($model->status == 2) {
        $question_pord++;
      }
    }
    $number_arr = array(
        'score_new' => $models[0]->score,
        'max_score' => max($score_arr),
        'question_all' => sizeof($models),
        'question_pord' => $question_pord
    );

    return $number_arr;
  }

  public function countModel($models) {
    if (!empty($models) && isset($models)) {
      $i = 0;
      foreach ($models as $model) {
        $i++;
      }

      return $i;
    }
    return 0;
  }

}
