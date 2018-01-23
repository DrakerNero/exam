<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question_set".
 *
 * @property integer $id
 * @property integer $subject_id
 * @property string $name
 * @property string $explanation
 * @property integer $from
 * @property integer $to
 * @property integer $total_time
 * @property integer $total_score
 * @property string $question_type
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class QuestionSet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'from', 'to', 'total_time', 'total_score', 'status'], 'integer'],
            [['explanation'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['question_type'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_id' => 'Subject ID',
            'name' => 'Name',
            'explanation' => 'Explanation',
            'from' => 'From',
            'to' => 'To',
            'total_time' => 'Total Time',
            'total_score' => 'Total Score',
            'question_type' => 'Question Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public function getQuestionSave()
    {
        return $this->hasMany(QuestionSave::className(), ['question_set_id' => 'id']);
    }
}
