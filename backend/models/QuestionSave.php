<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "question_save".
 *
 * @property integer $id
 * @property integer $question_set_id
 * @property string $user_id
 * @property string $mode
 * @property string $answer
 * @property integer $score
 * @property integer $elapse_time
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class QuestionSave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_save';
    }    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_set_id', 'score', 'elapse_time', 'status', 'created_at', 'updated_at'], 'integer'],
            [['answer'], 'string'],
            [['user_id', 'mode'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_set_id' => 'Question Set ID',
            'user_id' => 'User ID',
            'mode' => 'Mode',
            'answer' => 'Answer',
            'score' => 'Score',
            'elapse_time' => 'Elapse Time',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getQuestionSet()
    {
        return $this->hasOne(QuestionSet::className(), ['id' => 'question_set_id']);
    }

}
