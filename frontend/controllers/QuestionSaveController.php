<?php

namespace frontend\controllers;

use Yii;
use frontend\models\QuestionSave;
use frontend\models\QuestionSaveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\QuestionHistory;
use yii\filters\AccessControl;
use frontend\models\User;
use frontend\models\QuestionSet;

/**
 * QuestionSaveController implements the CRUD actions for QuestionSave model.
 */
class QuestionSaveController extends Controller {

  public function behaviors() {
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [

                    'actions' => ['history', 'monitor', 'click-save', 'finish-question', 'save-state-done', 'rescore', 'save-present-section', 'update-present-question',
                        'click-save-multi-choice',
                        'rescore-all-status',
                        'question-save-export-excel',
                        'question-save-export-excel-with-user',
                        'handle-post-submit-exam',
                        'question-save-export-attempt'
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
   * Lists all QuestionSave models.
   * @return mixed
   */
  public function actionIndex() {
    $searchModel = new QuestionSaveSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single QuestionSave model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id) {
    return $this->render('view', [
                'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new QuestionSave model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate() {
    $model = new QuestionSave();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
                  'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing QuestionSave model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id) {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('update', [
                  'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing QuestionSave model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
  public function actionDelete($id) {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * Finds the QuestionSave model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return QuestionSave the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id) {
    if (($model = QuestionSave::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  public function actionSaveStateDoing() {
    $model = $this->findModel($_POST['questionSaveId']);
    $model->status = 2;

    if ($model->save()) {
      return 'finish';
    } else {
      return 'error';
    }
  }

  public function actionSaveStateDone() {
    $model = $this->findModel($_POST['questionSaveId']);
    $model->status = 3;
    $model->score = $_POST['score'];
    $model->elapse_time += time() - $model->created_at;

    if ($model->save()) {
      /* Yii::$app->getSession()->setFlash('alert', [
        'title'=>Yii::t('frontend',$score.' คะแนน'),
        'body'=> Yii::t('frontend', 'โปรดดูเฉลยละเอียด'),
        ]);

        return $this->redirect(['question-set/do-exam' , 'id' => $model->questionId ]); */
    }
  }

  public function actionClickSave() {
    $questionId = $_POST['questionId'];
    $choices = $_POST['choices'];
    $multiChoice = $_POST['multiChoice'];
    $userId = '' . Yii::$app->user->identity->id;
    $part = $_POST['part'];

    $model = $this->findModel($_POST['questionSaveId']);

    $nameTime = 'time_' . $questionId;
    $date = date("Y-m-d H:i:s");

    $arraySave = array();
    $arraySave = json_decode($model->answer, true);
    $arrayNew = array();
    if (!is_array($arraySave)) {
      $arraySave = array();
    }
    $arrayNew['key'] = $questionId;
    $arrayNew['time'] = $date;
    $arrayNew['value'] = ($multiChoice) ? json_encode($choices) : $choices;
    $arrayNew['part'] = $part;

    $arraySave[$questionId] = $arrayNew;
//    $model->present_question = sizeof($arraySave) + 1;
    $model->answer = json_encode($arraySave, true);
    $model->save();

    echo 'สำเร็จ';
  }

  public function actionHistory() {
    if (!empty(Yii::$app->user->identity->id)) {
      $user_id = Yii::$app->user->identity->id;
      $models = QuestionSave::find()
              ->where(['user_id' => $user_id])
              ->orderBy(['id' => SORT_DESC])
              ->all();
//      $genGraphQuestion = QuestionHistory::Gen_Graph_Question($models);
      $genCounrNumber = QuestionHistory::countModel($models);
      $countExamSuccess = QuestionSave::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['>=', 'score', '80'])->count();

      return $this->render('history', [
                  'models' => $models,
//                  'genGraphQuestion' => $genGraphQuestion,
                  'genCounrNumber' => $genCounrNumber,
                  'countExamSuccess' => $countExamSuccess
      ]);
    } else {
      throw new NotFoundHttpException('คุณยังไม่ได้เข้าสู่ระบบ กรุณาเข้าส่ระบบ.');
    }
  }

  public function actionFinishQuestion() {
    $userId = Yii::$app->user->identity->id;

    $questionSetId = $_POST['questionSetId'];
    $model = QuestionSave::find()->where(['user_id' => $userId, 'question_set_id' => $questionSetId, 'status' => 1, 2])->one();
    $model->status = (int) 3;
    $model->save();
  }

  public function actionRescore() {
    $questionSetId = $_POST['questionSetId'];
    $questionSaveId = $_POST['questionSaveId'];
    $userId = Yii::$app->user->identity->id;
    $userId = $userId . '';
    $model = QuestionSave::find()->where([
                'id' => $questionSaveId,
//                'user_id' => $userId,
//                'question_set_id' => $questionSetId,
//                'status' => 3
            ])->one();
    $model->status = 4;
    $model->mode = '';
    $model->save();
    if ($model->save()) {
      $newModel = new QuestionSave();
      $newModel->user_id = $userId . '';
      $newModel->question_set_id = (int) $questionSetId;
      $newModel->elapse_time = $model->questionSet->total_time;
      $newModel->multi_select_choice = $model->multi_select_choice;
      $newModel->present_question = 1;
      $newModel->mode = '';
      $newModel->status = 1;
      if ($newModel->save()) {
        echo '1';
      }
    } else {
      echo '0';
    }
  }

  public function actionRescoreAllStatus() {
    $questionSetId = $_POST['questionSetId'];
    $userId = Yii::$app->user->identity->id;
    $userId = $userId . '';
    $model = QuestionSave::find()
            ->where([
                'user_id' => $userId,
                'question_set_id' => $questionSetId,
            ])
            ->andWhere(['not', ['status' => 4]])
            ->one();
    $model->status = 4;
    $model->save();
    if ($model->save()) {
      $newModel = new QuestionSave();
      $newModel->user_id = $userId . '';
      $newModel->question_set_id = (int) $questionSetId;
      $newModel->elapse_time = $model->questionSet->total_time;
      $newModel->multi_select_choice = $model->multi_select_choice;
      $newModel->present_question = 1;
      $newModel->status = 1;
      if ($newModel->save()) {
        echo '1';
      }
    } else {
      echo '0';
    }
  }

  public function actionMonitor($email) {
    $titleSearch = '';
    if (Yii::$app->user->identity->user_status == 1) {
      if ($email == "0") {
        $titleSearch = "กรุณาใส่ข้อมูล";
        return $this->render('search_mail', ['titleSearch' => $titleSearch]);
      } else {
        $user = User::find()->where(['username' => $email])->one();
        if (!empty($user)) {
          $titleSearch = '';
          $models = QuestionSave::find()->where(['user_id' => $user->id])->all();
          return $this->render('search_mail', ['models' => $models, 'titleSearch' => $titleSearch, 'user' => $user]);
        } else {
          $titleSearch = 'ไม่พบข้อมูล';
          return $this->render('search_mail', ['titleSearch' => $titleSearch]);
        }
      }
    } else {
      return $this->goHOme();
    }
  }

  public function actionSavePresentSection() {
    $questionSaveId = $_POST['questionSaveId'];
    $presentSection = $_POST['presentSection'];
    $sectionQuestionMax = $_POST['sectionQuestionMax'];

    if (!empty(Yii::$app->user->identity->id) && isset(Yii::$app->user->identity->id)) {
      $model = $this->findModel($questionSaveId);
      $model->present_section = $presentSection;

      if ($model->present_section <= $sectionQuestionMax) {
        $model->save();
      }
    }
  }

  public function actionUpdatePresentQuestion() {
    $postPresentQuestion = $_POST['presentQuestion'];
    $id = $_POST['id'];

    $model = $this->findModel($id);
    $model->present_question = $postPresentQuestion;
    $model->save();
    $answers = json_decode($model->answer);
    $doPart = 1;

    foreach ($answers as $answer) {
      $doPart = $answer->part;
    }

    return $doPart;
  }

  public function actionQuestionSaveExportExcel($questionSetId) {
    $this->layout = 'blank';
    $models = QuestionSave::find()->where(['question_set_id' => $questionSetId])->all();


    if (count($models) >= 1) {
      return $this->render('question_set_export_excel', ['models' => $models]);
    } else {
      
    }
  }

  public function actionQuestionSaveExportExcelWithUser($academic = null, $rotation = null) {
    $this->layout = 'blank';

    $arrWhere = [];
    $arrUserId = [];
    ($academic != null) ? $arrWhere['start_study'] = $academic : null;
    ($rotation != null) ? $arrWhere['rotation'] = $rotation : null;
    $modelUsers = User::find()->where($arrWhere)->all();
    foreach ($modelUsers as $user) {
      array_push($arrUserId, $user->id);
    }
    if ($academic == null && $rotation == null) {
      $models = QuestionSave::find()
              ->where(['!=', 'module_part', ''])
              ->all();
    } else {
      $models = QuestionSave::find()
              ->where(['id' => $arrUserId])
              ->andWhere(['!=', 'module_part', ''])
              ->all();
    }

    return $this->render('question_set_export_excel', ['models' => $models]);
//    if (count($models) >= 1) {
//      return $this->render('question_set_export_excel', ['models' => $models]);
//    } else {
//      echo 'ไม่พบข้อมูลนักเรียน';
//    }
  }

  public function actionHandlePostSubmitExam() {
    $this->layout = 'blank';
    $questionSaveId = $_POST['questionSaveId'];
    $score = $_POST['score'];
    $stringSelectChoice = $_POST['stringSelectChoice'];
    $questionSelectChoices = [];
    $questionSaves = [];
    $time = date('Y-m-d H:i:s');
    $questionSave = QuestionSave::find()->where(['id' => $questionSaveId])->one();
//    $questionSave->answer = [];
//    $questionSave->answer = json_encode($questionSave->answer);
//    $questionSave->answer = json_decode($questionSave->answer);

    $questionExplode = explode('&', $stringSelectChoice);

    foreach ($questionExplode as $questionString) {
      $arrSave = [];
      $choices = explode(',', $questionString);
      $arrChoice = [];
      $key = $choices[0];
      unset($choices[0]);
      foreach ($choices as $choice) {
        (!empty($choice) && isset($choice) && $choice != '') ? array_push($arrChoice, $choice) : null;
      }

      $questionSelectChoices[$key] = $choices;
      $arrSave['key'] = $key;
      $arrSave['value'] = json_encode($arrChoice);
      $arrSave['time'] = $time;
      $questionSaves[$key] = $arrSave;
    }

    $questionSave->answer = json_encode($questionSaves);
    $questionSave->score = (int) $score;
    $questionSave->status = 3;
    $questionSave->updated_at = (int) strtotime(date('Y-m-d H:i:s'));
    $questionSave->save();
  }

  public function actionQuestionSaveExportAttempt($rotation = null, $startStudy = null) {
    $this->layout = 'blank';
    $userWhere = ['status' => 1];
    echo $startStudy;
    (!empty($rotation) && isset($rotation) && $rotation != null ) ? $userWhere['rotation'] = $rotation : null;
    (!empty($startStudy) && isset($startStudy) && $startStudy != null ) ? $userWhere['start_study'] = $startStudy : null;

    print_r($userWhere);
    $userModels = User::find()
            ->where($userWhere)
            ->all();

    if (count($userModels) >= 1) {

      $questionSetCount = QuestionSet::find()->where(['status' => 1])->count();

      return $this->render('question_save_export_attempt', [
                  'userModels' => $userModels,
                  'questionSetCount' => $questionSetCount,
      ]);
    } else {
      
    }
  }

}
