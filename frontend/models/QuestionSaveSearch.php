<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\QuestionSave;

/**
 * QuestionSaveSearch represents the model behind the search form about `frontend\models\QuestionSave`.
 */
class QuestionSaveSearch extends QuestionSave {

  /**
   * @inheritdoc
   */
  public $questionSet;
  public $firstName;
  public $lastName;

  public function rules() {
    return [
        [['id', 'user_id'], 'integer'],
        [['question_set_id', 'answer', 'status', 'questionSet'], 'safe'],
        [['firstName', 'lastName'], 'safe'],
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
    $query = QuestionSave::find();

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
        'user_id' => $this->user_id,
//            'updated' => $this->updated,
    ]);

    $query->andFilterWhere(['like', 'question_set_id', $this->question_set_id])
//            ->andFilterWhere(['like', 'question_type', $this->question_type])
            ->andFilterWhere(['like', 'answer', $this->answer])
//            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'status', $this->status]);

    return $dataProvider;
  }

  public function search2($params) {
    $query = QuestionSave::find();
    $query->joinWith(['questionSet', 'userProfile']);

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $dataProvider->sort->attributes['questionSet'] = [
        'asc' => ['questionSet.id' => SORT_ASC],
        'desc' => ['questionSet.id' => SORT_DESC],
    ];
    $dataProvider->sort->attributes['userProfile'] = [
        'asc' => ['userProfile.id' => SORT_ASC],
        'desc' => ['userProfile.id' => SORT_DESC],
    ];

    $this->load($params);

    if (!$this->validate()) {
      return $dataProvider;
    }

    $query->andFilterWhere([
        'id' => $this->id,
        'user_id' => $this->user_id,
    ]);

    $query->andFilterWhere(['like', 'question_save.question_set_id', $this->question_set_id])
            ->andFilterWhere(['like', 'question_save.answer', $this->answer])
            ->andFilterWhere(['like', 'question_set.name', $this->questionSet])
            ->andFilterWhere(['like', 'user.firstname', $this->firstName])
            ->andFilterWhere(['like', 'user.lastname', $this->lastName])
            ->andFilterWhere(['like', 'question_save.status', $this->status]);

    return $dataProvider;
  }

  public function searchByUserId($params, $userId) {
    $query = QuestionSave::find()->where(['user_id' => $userId]);

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
        'user_id' => $this->user_id,
//            'updated' => $this->updated,
    ]);

    $query->andFilterWhere(['like', 'question_set_id', $this->question_set_id])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'status', $this->status]);

    return $dataProvider;
  }

}
