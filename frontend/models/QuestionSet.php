<?php

namespace frontend\models;

use yii\helpers\URL;
use frontend\models\QuestionSetBase;
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
 * @property string $question_type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Subject $subject
 */
class QuestionSet extends QuestionSetBase
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id' ]);
    }

    public function LoadQuestion($id)
    {
        return $model = Question::findOne($id);
    }

    public function CheckStatusUser()
    {
        $userID = Yii::$app->user->identity->id;
        if ( empty($userID) )
        {
            return Url::to(['my_controller/action' ], true);
        }
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionSaves()
    {
        return $this->hasMany(QuestionSave::className(), ['question_set_id' => 'id']);
    }
}
