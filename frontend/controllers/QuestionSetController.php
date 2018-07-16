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
use frontend\models\QuestionMaster;

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
                        'exam2',
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

  public function getModelQuestionWithPart($questions, $parts) {
    $arr = [];
    $arrQuestion = [];
    $totalQuestion = 0;
    foreach ($questions as $question) {
      if (in_array($question->part, $parts)) {
        array_push($arrQuestion, [
            'id' => $question->id,
            'question_topic' => $question->question_topic,
            'question' => $question->question,
            'part' => $question->part,
            'type_question' => $question->type_question,
            'max_select_choice' => $question->max_select_choice,
            'choices' => $question->choices,
            'answer' => $question->answer,
            'answers' => $question->answers,
            'answer_score' => $question->answer_score,
            'answer_detail' => $question->answer_detail,
            'mp3' => $question->mp3,
            'png' => $question->png,
        ]);

        $totalQuestion++;
      }
    }

    return [
        'questions' => $arrQuestion,
        'totalQuestion' => $totalQuestion,
    ];
  }

  public function handleRandomSizeArray($arr) {
    return rand(1, sizeof(array_values(array_unique($arr))) - 1);
  }

  public function newModelQuestionSave($questionSetId, $parts) {
    $model = new QuestionSave();
    $model->question_set_id = $questionSetId;
    $model->user_id = '' . Yii::$app->user->identity->id;
    $model->module_part = json_encode($parts);
    $model->present_question = 1;
    $model->multi_select_choice = 1;
    $model->score = '';
    $model->elapse_time = 0;
    $model->status = 1;
    $model->mode = '';
    $model->answer = '';
//    $model->created_at = 1531653284;
//    $model->updated_at = 1531653284;
//    echo '<pre>';
//    print_r($model);

    $model->save();
  }

  public function getArrQuestion($model) {
    $questionSave = $this->isQuestionSaveExamTypeJump($model->id);
    $arrPart = [];
    $arrModel = [];
    $arrMode_1 = [];
    $arrMode_2 = [];
    $arrModel['questionSet'] = [
        'id' => $model->id,
        'subject_id' => $model->subject_id,
        'mode' => $model->mode,
        'name' => $model->name,
        'explanation' => $model->explanation,
        'total_module' => $model->total_module,
        'multi_select_choice' => $model->multi_select_choice,
        'from' => $model->from,
        'to' => $model->to,
        'total_time' => $model->total_time,
        'total_score' => $model->total_score,
        'question_type' => $model->question_type,
        'select_question_type' => $model->select_question_type,
    ];
    if (!empty($questionSave) && isset($questionSave) && $questionSave->module_part != null && $questionSave->module_part != '') {
      $questions = Question::find()
              ->where(['part' => json_decode($questionSave->module_part)])
              ->andWhere(['>=', 'id', $model->from])
              ->andWhere(['<=', 'id', $model->to])
              ->all();
    } else {
      $questions = Question::find()
              ->where(['>=', 'id', $model->from])
              ->andWhere(['<=', 'id', $model->to])
              ->all();
      foreach ($questions as $question) {
        if ($question->part < 100) {
          array_push($arrMode_1, $question->part);
        } else {
          array_push($arrMode_2, $question->part);
        }
      }
      $random_1 = array_values(array_unique($arrMode_1))[$this->handleRandomSizeArray(array_values(array_unique($arrMode_1)))];
      $random_2 = array_values(array_unique($arrMode_2))[$this->handleRandomSizeArray(array_values(array_unique($arrMode_2)))];

      array_push($arrPart, $random_1);
      array_push($arrPart, $random_2);
      $arr = [];
      $modelQuestionWithPart = $this->getModelQuestionWithPart($questions, $arrPart);
      $this->newModelQuestionSave($model->id, $arrPart);


      $arr['questions'] = $modelQuestionWithPart['questions'];
      $arr['totalModule'] = $modelQuestionWithPart['totalQuestion'];
      $arr['parts'] = $arrPart;
      $questions = Question::find()
              ->where(['part' => $arrPart])
              ->andWhere(['>=', 'id', $model->from])
              ->andWhere(['<=', 'id', $model->to])
              ->all();
    }
    $returnArr = ['questions' => $questions, 'questionSave' => $questionSave];
    return $returnArr;
//    return $arr;
  }

  public function isQuestionSaveExamTypeJump($questionSetId) {
    $model = QuestionSave::find()->where(['user_id' => Yii::$app->user->identity->id, 'status' => [1, 3], 'question_set_id' => $questionSetId])->one();
    if (!empty($model) && isset($model)) {
      return $model;
    }

    return null;
  }

  public function actionDoExam($questionSetId) {
    $isAdmin = false;
    $model = QuestionSet::findOne($questionSetId);
    if (!empty($model)) {
      if (!empty($model->mode) && isset($model->mode) && $model->mode == 2) { // ข้อสอบกระโดด
        $this->layout = 'main_exam_2';
        $getDataQuestion = $this->getArrQuestion($model);
        $handleQuestions = $getDataQuestion['questions'];
        $questionSave = $getDataQuestion['questionSave'];
        return $this->render('exam2', [
                    'model' => $model,
                    'questionSave' => $questionSave,
                    'questions' => $handleQuestions,
                    'isAdmin' => $isAdmin,
        ]);
      } else {

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
//                    'uniquePart' => $uniquePart,
//                    'newQuestions' => $questionSuccess,
                    'doPart' => $doPart,
                    'isAdmin' => $isAdmin,
//                  'inArrayModulePart' => $inArrayModulePart,
        ]);
      }
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
    $isAdmin = true;
    $questionSave = QuestionSave::findOne($questionSaveId);
    if (!empty($questionSave)) {
      if (Yii::$app->user->identity->user_status == 1) {
        $model = QuestionSet::findOne($questionSave->question_set_id);
        $questions = Question::find()
                ->where(['>=', 'id', $model->from])
                ->andWhere(['<=', 'id', $model->to])
                ->all();

        // START

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

        // END


        return $this->render('exam', ['model' => $model, 'questionSave' => $questionSave, 'questions' => $questionSuccess, 'disableChoice' => $disableChoice, 'isAdmin' => $isAdmin]);
      } else {
        return $this->redirect(['site/index']);
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

  public function getQuestionWithPart($part, $from, $to) {
    $arr = [];
    $arrName = [];
    $models = Question::find()
            ->where(['part' => $part])
            ->andWhere(['>=', 'id', $from])
            ->andWhere(['<=', 'id', $to])
            ->all();
    foreach ($models as $model) {
      array_push($arrName, [
          'id' => $model->id,
          'question_topic' => $model->question_topic,
          'question' => $model->question,
          'part' => $model->part,
          'type_question' => $model->type_question,
          'max_select_choice' => $model->max_select_choice,
          'choices' => $model->choices,
          'answer' => $model->answer,
          'answers' => $model->answers,
          'answer_score' => $model->answer_score,
          'answer_detail' => $model->answer_detail,
          'mp3' => $model->mp3,
          'png' => $model->png,
      ]);
    }

    return $arrName;
  }

  public function getArrQuestionSet($subjectId) {
    $model = QuestionSet::find()->where(['subject_id' => $subjectId])->one();
    $arrPart = [];
    $arrModelSuccess = [];
    $arrModel = [];
    $arrModel['questionSet'] = [
        'id' => $model->id,
        'subject_id' => $model->subject_id,
        'mode' => $model->mode,
        'name' => $model->name,
        'explanation' => $model->explanation,
        'total_module' => $model->total_module,
        'multi_select_choice' => $model->multi_select_choice,
        'from' => $model->from,
        'to' => $model->to,
        'total_time' => $model->total_time,
        'total_score' => $model->total_score,
        'question_type' => $model->question_type,
        'select_question_type' => $model->select_question_type,
    ];
    $questions = Question::find()
            ->where(['>=', 'id', $model->from])
            ->andWhere(['<=', 'id', $model->to])
            ->all();
    foreach ($questions as $question) {
      array_push($arrPart, $question->part);
    }
    $randomArrPart = array_rand(array_values(array_unique($arrPart))) + 1;
    $arrModel['questions'] = $this->getQuestionWithPart($randomArrPart, $model->from, $model->to);

    return $arrModel;
  }

  public function actionExam2($id) {
    $this->layout = 'main_exam_2';
    $questionMaster = QuestionMaster::find()->where(['id' => $id])->one();

    if (!empty($questionMaster) && isset($questionMaster) && $questionMaster != null) {
      if ($questionMaster->mode == 2) {
        $questions = [];
        $questionSave = (object) ['status' => 0];  // mock data
        $exploreQuestionSets = explode(',', $questionMaster->question_sets);
        foreach ($exploreQuestionSets as $exploreQuestionSet) {
          array_push($questions, $this->getArrQuestionSet($exploreQuestionSet));
        }
        //
        return $this->render('exam2', [
                    'questionSave' => $questionSave,
                    'models' => (object) $questions,
                    'questionMaster' => $questionMaster,
        ]);
      } else if ($questionMaster->mode == 1) {
        return $this->redirect(['do-exam', ['questionSetId' => $id]]);
      } else {
        return $this->redirect(['site/index']);
      }
    } else {
      return $this->redirect(['site/index']);
    }
  }

}
