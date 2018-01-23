<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $exam_class
 * @property string $exam_subclass
 * @property string $status
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_class', 'exam_subclass', 'status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_class' => 'Exam Class',
            'exam_subclass' => 'Exam Subclass',
            'status' => 'Status',
        ];
    }

    public function getQuestionSet()
    {
        return $this->hasMany(QuestionSet::className(), ['subject_id' => 'id']);
    }
}
