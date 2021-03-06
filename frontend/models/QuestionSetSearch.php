<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\QuestionSet;

/**
 * QuestionSetSearch represents the model behind the search form about `frontend\models\QuestionSet`.
 */
class QuestionSetSearch extends QuestionSet {

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
        [['id'], 'integer'],
        [['explanation', 'name', 'question_type', 'status', 'created_at', 'updated_at'], 'safe'],
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
    $query = QuestionSet::find();

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
        'id' => $this->id,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ]);

    $query->andFilterWhere(['like', 'explanation', $this->explanation])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'question_type', $this->question_type])
            ->andFilterWhere(['like', 'status', $this->status]);

    return $dataProvider;
  }

}
