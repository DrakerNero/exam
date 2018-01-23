<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\QuestionSave;

/**
 * QuestionSaveSearch represents the model behind the search form about `backend\models\QuestionSave`.
 */
class QuestionSaveSearch extends QuestionSave
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'score', 'elapse_time', 'status', 'created_at', 'updated_at'], 'integer'],
            [['user_id', 'question_set_id', 'mode', 'answer'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = QuestionSave::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

         $query->joinWith('questionSet');

        $query->andFilterWhere([
            'id' => $this->id,
           // 'question_set_id' => $this->question_set_id,
            'score' => $this->score,
            'elapse_time' => $this->elapse_time,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'mode', $this->mode])
            ->andFilterWhere(['like', 'question_set.name', $this->question_set_id])
            ->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}
