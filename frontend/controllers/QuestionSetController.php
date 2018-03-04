<?php

namespace frontend\controllers;

use Yii;
use frontend\models\QuestionSet;
use frontend\models\QuestionSetSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Question;
use frontend\models\QuestionSearch;
use frontend\models\QuestionSave;

/**
 * QuestionSetController implements the CRUD actions for QuestionSet model.
 */
class QuestionSetController extends Controller {

  public $layout = 'main_exam';

  public function behaviors() {
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [

                    'actions' => [
                        'do-exam',
                        'scholarship-exam',
                        'create',
                        'update',
                        'index',
                        'view',
                        'monitor-user-do-exam',
                        'teacher',
                        'print-file-exam',
                    ],
                    'allow' => true,
                    'roles' => ['@']
                ],
            ],
        ],
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['post'],
            ],
        ],
    ];
  }

  /**
   * Lists all QuestionSet models.
   * @return mixed
   */
  public function actionIndex() {
    $this->layout = 'main_backend';
    $searchModel = new QuestionSetSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single QuestionSet model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id) {
    $this->layout = 'main_backend';
    return $this->render('view', [
                'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new QuestionSet model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate() {
    $this->layout = 'main_backend';
    $model = new QuestionSet();


    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
                  'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing QuestionSet model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id) {
    $this->layout = 'main_backend';
    $model = $this->findModel($id);
    $questions = Question::find()
            ->where(['>=', 'id', $model->from])
            ->andWhere(['<=', 'id', $model->to]);
//            ->all();

    $questionSearch = new QuestionSearch();
    $dataProvider = $questionSearch->searchByQuery(Yii::$app->request->queryParams, $questions);

    if ($model->load(Yii::$app->request->post())) {
      $model->updated_at = date('Y-m-d H:i:s');
      $model->save();

      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('update', [
                  'model' => $model,
                  'questions' => $questions,
                  'dataProvider' => $dataProvider,
                  'questionSearch' => $questionSearch,
      ]);
    }
  }

  /**
   * Deletes an existing QuestionSet model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
  public function actionDelete($id) {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * Finds the QuestionSet model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return QuestionSet the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id) {
    if (($model = QuestionSet::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  /**
   * Finds the QuestionSet model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $questionSetId
   * @return mixed
   */
  public function actionScholarshipExam($questionSetId) {

    $model = QuestionSet::findOne($questionSetId);
    if (!empty($model)) {
      $questionSave = QuestionSave::LoadQuestionSave($model->id);
      $arrQuestion = [];
      for ($i = $model->from; $i <= $model->to; $i++) {
        $arrQuestion[$i] = $i;
      }
      $questions = Question::find()->where(['id' => $arrQuestion])->all();
      if ($model->question_type == 2) {
        return $this->render('exam_type_2', ['model' => $model, 'questionSave' => $questionSave, 'questions' => $questions]);
      } else {
        return $this->redirect(['site/index']);
      }
    } else {
      throw new NotFoundHttpException('The question set you have requested is not available');
    }
//        $model = Question::findBySql($sql)
  }

  public function actionDoExam($questionSetId) {
    $onAdmin = false;
    $model = QuestionSet::findOne($questionSetId);
    if (!empty($model)) {
      $arrQuestion = [];
      for ($i = $model->from; $i <= $model->to; $i++) {
        $arrQuestion[$i] = $i;
      }
      $questions = Question::find()->where(['id' => $arrQuestion])->all();
      $parts = [];
      $moduleQuestion = [];
      $questionSuccess = [];
      foreach ($questions as $question) {
        if (!empty($question->part) && isset($question->part)) {
          array_push($parts, $question->part);
        } else {
          
        }
      }
      $uniquePart = array_values(array_unique($parts));
      $questionSave = QuestionSave::LoadQuestionSave($model->id, min($uniquePart));

      foreach (array_rand($uniquePart, $model->total_module) as $keyModule) { // loop เพื่อ random module ของ question_set
        array_push($moduleQuestion, $uniquePart[$keyModule]);
      }

      $totalModule = array_rand(array_values(array_unique($parts)), $model->total_module);
      if ($questionSave->module_part === '' || $questionSave->module_part === null) {
        $questionSave->module_part = json_encode($moduleQuestion);
        $questionSuccess = $this->setRandomQuestionForExam($questions, $moduleQuestion);
        $questionSave->save();
      } else {
        $questionSave->module_part = json_decode($questionSave->module_part);
        $questionSuccess = $this->setRandomQuestionForExam($questions, $questionSave->module_part);
      }

      $questionSaveChoices = json_decode($questionSave->answer);
      $doPart = 0;
      if (isset($questionSaveChoices)) {

        foreach ($questionSaveChoices as $answer) {
          $doPart = $answer->part;
        }
      } else {
        
      }


      return $this->render('exam', [
                  'model' => $model,
                  'questionSave' => $questionSave,
                  'questions' => $questionSuccess,
                  'totalModule' => $totalModule,
                  'part' => $parts,
                  'uniquePart' => $uniquePart,
                  'newQuestions' => $questionSuccess,
                  'doPart' => $doPart,
                  'onAdmin' => $onAdmin,
//                  'inArrayModulePart' => $inArrayModulePart,
      ]);
    } else {
      throw new NotFoundHttpException('The question set you have requested is not available');
    }
  }

  public function setRandomQuestionForExam($questions, $arrForUseQuestion) {
    $newQuestion = [];
    foreach ($questions as $question) { // loop เพื่อดึงเพื่อเฉพาะ question ที่อยู่ใน module ที่ random ออกมาเท่านั้น
      in_array($question->part, $arrForUseQuestion) ? array_push($newQuestion, $question) : null;
    }

    return $newQuestion;
  }

  public function actionMonitorUserDoExam($questionSaveId) {
    $disableChoice = false;
    $onAdmin = true;
    $questionSave = QuestionSave::findOne($questionSaveId);
    if (!empty($questionSave)) {
      if (Yii::$app->user->identity->user_status == 1) {
        $model = QuestionSet::findOne($questionSave->question_set_id);
        $questions = Question::find()
                ->where(['>=', 'id', $model->from])
                ->andWhere(['<=', 'id', $model->to])
                ->all();
        return $this->render('exam', ['model' => $model, 'questionSave' => $questionSave, 'questions' => $questions, 'disableChoice' => $disableChoice, 'onAdmin' => $onAdmin]);
      } else {
//        return $this->redirect(['site/index']);
      }
    } else {
      throw new NotFoundHttpException('The question set you have requested is not available');
    }
  }

  public function actionTeacher($id) {
    return $this->render('teacher', ['id' => $id]);
  }

  public function actionPrintFileExam($id) {
    $this->layout = 'blank';
    $questionSet = QuestionSet::find()->where(['id' => $id])->one();
    $questions = Question::find()
            ->where(['>=', 'id', $questionSet->from])
            ->andWhere(['<=', 'id', $questionSet->to])
            ->all();
    return $this->render('print_file_exam', ['questions' => $questions, 'questionSet' => $questionSet]);
  }

//  public function actionQuestionSetExportExcel($id) {
////    $models = QuestionSet::find()->where(['id' => $id])->all();
//    
//  }

}
