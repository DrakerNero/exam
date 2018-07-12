<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "question_master".
 *
 * @property int $id
 * @property string $topic
 * @property string $name
 * @property string $question_sets
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 * @property int $total_time
 * @property int $multi_select_choice
 * @property int $mode
 */
class QuestionMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_sets'], 'string'],
            [['active', 'created_at', 'updated_at', 'total_time', 'multi_select_choice', 'mode'], 'integer'],
            [['topic', 'name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic' => 'Topic',
            'name' => 'Name',
            'question_sets' => 'Question Sets',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'total_time' => 'Total Time',
            'multi_select_choice' => 'Multi Select Choice',
            'mode' => 'Mode',
        ];
    }
}
