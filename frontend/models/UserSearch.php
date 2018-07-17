<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\User;

/**
 * UserSearch represents the model behind the search form about `frontend\models\User`.
 */
class UserSearch extends User {

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
        [['id', 'status', 'user_status', 'created_at', 'updated_at', 'logged_at'], 'integer'],
        [['username', 'auth_key', 'password_hash', 'password_reset_token', 'oauth_client', 'oauth_client_user_id', 'email', 'first_name', 'last_name', 'student_id', 'start_study', 'support_password', 'rotation'], 'safe'],
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
    $query = User::find()->where(['status' => 1]);

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    $query->andFilterWhere([
        'id' => $this->id,
        'status' => $this->status,
        'user_status' => $this->user_status,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        'logged_at' => $this->logged_at,
    ]);

    $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'oauth_client', $this->oauth_client])
            ->andFilterWhere(['like', 'oauth_client_user_id', $this->oauth_client_user_id])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'student_id', $this->student_id])
            ->andFilterWhere(['like', 'start_study', $this->start_study])
            ->andFilterWhere(['like', 'rotation', $this->rotation])
            ->andFilterWhere(['like', 'support_password', $this->support_password]);

    return $dataProvider;
  }

  public function searchMonitor($params, $academic = null, $rotation = null) {
    $arrWhere = ['status' => 1];
    ($academic != null) ? $arrWhere['start_study'] = $academic : null;
    ($rotation != null) ? $arrWhere['rotation'] = $rotation : null;

    if ($academic != null || $rotation != null) {
      $query = User::find()->where($arrWhere);
    } else {
      $query = User::find();
    }

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
        'status' => $this->status,
        'user_status' => $this->user_status,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        'logged_at' => $this->logged_at,
    ]);

    $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'oauth_client', $this->oauth_client])
            ->andFilterWhere(['like', 'oauth_client_user_id', $this->oauth_client_user_id])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'student_id', $this->student_id])
            ->andFilterWhere(['like', 'start_study', $this->start_study])
            ->andFilterWhere(['like', 'rotation', $this->rotation])
            ->andFilterWhere(['like', 'support_password', $this->support_password]);

    return $dataProvider;
  }

}
