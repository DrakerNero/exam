<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\QuestionSet;

/**
 * QuestionSetSearch represents the model behind the search form about `backend\models\QuestionSet`.
 */
class QuestionSetSearch extends QuestionSet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'from', 'to', 'total_time', 'total_score', 'status'], 'integer'],
            [['name', 'explanation', 'subject_id', 'question_type', 'created_at', 'updated_at'], 'safe'],
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
        $query = QuestionSet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->joinWith('subject');
        
        $query->andFilterWhere([
            'id' => $this->id,
           // 'subject_id' => $this->subject_id,
            'from' => $this->from,
            'to' => $this->to,
            'total_time' => $this->total_time,
            'total_score' => $this->total_score,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'explanation', $this->explanation])
            ->andFilterWhere(['like', 'subject.exam_class', $this->subject_id])
            ->andFilterWhere(['like', 'question_type', $this->question_type]);

        return $dataProvider;
    }
}
