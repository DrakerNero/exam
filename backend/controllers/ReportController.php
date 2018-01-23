<?php

namespace backend\controllers;

use Yii;
use backend\models\QuestionSave;
use backend\models\QuestionSaveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Subject;

/**
 * QuestionSaveController implements the CRUD actions for QuestionSave model.
 */
class ReportController extends Controller
{
    

    public function actionQuestionSave()
    {
        $models = QuestionSave::find()->where(['status' => 3])->all();       
        if(isset($_GET['from_date']))
        {

            $from_date = date("U", strtotime($_GET['from_date']));
            $to_date = date("U", strtotime($_GET['to_date'])); 
            if(isset($_GET['status'])){
                $status = $_GET['status'];
            } else 
            {
                $status =3;
            }
            if($to_date == $from_date)
            {
                 $models = QuestionSave::find()     
                    ->where(['status' => $status])       
                    ->andWhere(['like', 'created_at',  $from_date])
                    ->all();
            } else 
            {
                $models = QuestionSave::find()     
                    ->where(['status' => $status])       
                    ->andWhere(['between', 'created_at',  $from_date,$to_date])
                    ->all();
            }       
            
        }
        return $this->render('question-save',['models' => $models]);
    }

    public function actionSubject()
    {
        $models = Subject::find()->all();

        if(isset($_GET['exam_class']))
        {
            $exam_class = $_GET['exam_class'];
            $models = Subject::find()->where(['exam_class' => $exam_class])->all();
        }
        return $this->render('subject',[
            'models' => $models
            ]);
    }

}
