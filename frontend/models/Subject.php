<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $exam_class
 * @property string $exam_subclass
 *
 * @property QuestionSet[] $questionSets
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
            [['exam_class', 'exam_subclass'], 'string', 'max' => 255]
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionSets()
    {
        return $this->hasMany(QuestionSet::className(), ['subject_id' => 'id']);
    }
}
