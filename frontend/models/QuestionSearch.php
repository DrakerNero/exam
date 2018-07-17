<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Question;

/**
 * QuestionSearch represents the model behind the search form about `frontend\models\Question`.
 */
class QuestionSearch extends Question {

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
        [['id', 'type_question'], 'integer'],
        [['question', 'answer', 'answer_detail', 'mp3', 'png', 'txt', 'updated_at', 'question_topic',], 'safe'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function scenarios() {
    // bypass scenarios() implementation in the parent class
    return Model::scenarios();
  }

  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   *
   * @return ActiveDataProvider
   */
  public function search($params) {
    $query = Question::find();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
    ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    $query->andFilterWhere([
//        'id' => $this->id,
//            'question_number' => $this->question_number,
        'type_question' => $this->type_question,
        'created' => $this->updated_at,
    ]);

    $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'id', $this->id])
//            ->andFilterWhere(['like', 'choices_2', $this->choices_2])
//            ->andFilterWhere(['like', 'choices_3', $this->choices_3])
//            ->andFilterWhere(['like', 'choices_4', $this->choices_4])
//            ->andFilterWhere(['like', 'choices_5', $this->choices_5])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'answer_detail', $this->answer_detail])
            ->andFilterWhere(['like', 'mp3', $this->mp3])
            ->andFilterWhere(['like', 'png', $this->png])
            ->andFilterWhere(['like', 'txt', $this->txt]);

    return $dataProvider;
  }

  public function searchByQuery($params, $query) {
//    $query = Question::find();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'sort' => ['defaultOrder' => ['id' => SORT_ASC]],
        'pagination' => [
            'pageSize' => 20
        ]
    ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    $query->andFilterWhere([
        'id' => $this->id,
//            'question_number' => $this->question_number,
        'type_question' => $this->type_question,
        'created' => $this->updated_at,
    ]);

    $query->andFilterWhere(['like', 'question', $this->question])
//            ->andFilterWhere(['like', 'choices_1', $this->choices_1])
//            ->andFilterWhere(['like', 'choices_2', $this->choices_2])
//            ->andFilterWhere(['like', 'choices_3', $this->choices_3])
//            ->andFilterWhere(['like', 'choices_4', $this->choices_4])
//            ->andFilterWhere(['like', 'choices_5', $this->choices_5])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'answer_detail', $this->answer_detail])
            ->andFilterWhere(['like', 'mp3', $this->mp3])
            ->andFilterWhere(['like', 'png', $this->png])
            ->andFilterWhere(['like', 'txt', $this->txt]);

    return $dataProvider;
  }

}
