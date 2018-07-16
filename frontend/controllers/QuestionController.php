<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Question;
use frontend\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller {

  public function behaviors() {
    return [
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['post'],
            ],
        ],
    ];
  }

  /**
   * Lists all Question models.
   * @return mixed
   */
  public function actionIndex() {
    $this->layout = 'main_backend';
    $searchModel = new QuestionSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Question model.
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
   * Creates a new Question model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  private function choiceNames() {
    return [
        'choice_1',
        'choice_2',
        'choice_3',
        'choice_4',
        'choice_5',
        'choice_6',
        'choice_7',
        'choice_8',
        'choice_9',
        'choice_10',
        'choice_11',
        'choice_12',
        'choice_13',
        'choice_14',
        'choice_15',
    ];
  }

  public function answerNames() {
    return [
        'answer_1',
        'answer_2',
        'answer_3',
        'answer_4',
        'answer_5',
        'answer_6',
        'answer_7',
        'answer_8',
        'answer_9',
        'answer_10',
        'answer_11',
        'answer_12',
        'answer_13',
        'answer_14',
        'answer_15',
    ];
  }

  public function treeNames() {
    return [
        'tree_1',
        'tree_2',
        'tree_3',
        'tree_4',
        'tree_5',
        'tree_6',
        'tree_7',
        'tree_8',
        'tree_9',
        'tree_10',
        'tree_11',
        'tree_12',
        'tree_13',
        'tree_14',
        'tree_15',
    ];
  }

  public function jumpChoiceName() {
    return [
        'jump_choice_1',
        'jump_choice_2',
        'jump_choice_3',
        'jump_choice_4',
        'jump_choice_5',
        'jump_choice_6',
        'jump_choice_7',
        'jump_choice_8',
        'jump_choice_9',
        'jump_choice_10',
        'jump_choice_11',
        'jump_choice_12',
        'jump_choice_13',
        'jump_choice_14',
        'jump_choice_15',
    ];
  }

  public function setJsonJump() {
    return [
        'jump_type' => 1, // 1: กระโดดตาม choice ที่เลือก,  2: ใช้ผลรวมในการกระโดด
        'jump_constraint' => 1, // 1: >=,  2: <=,  3: ==
        'jump_score' => 0,
        'jump_constraint_true' => '',
        'jump_constraint_false' => '',
    ];
  }

  public function actionCreate() {
    $this->layout = 'main_backend';
    $model = new Question();
    $model = $this->decodeModelWithArray($model, $this->choiceNames(), 'choices');
    $model = $this->decodeModelWithArray($model, $this->answerNames(), 'answers');
    $model = $this->decodeModelWithArray($model, $this->jumpChoiceName(), 'jump_choices');
    $model->jump_json = json_encode($this->setJsonJump());
    $model->jump_json = json_decode($model->jump_json);
//
    $model->jump_type = $model->jump_json->jump_type;
    $model->jump_constraint = $model->jump_json->jump_constraint;
    $model->jump_score = $model->jump_json->jump_score;
    $model->jump_constraint_true = $model->jump_json->jump_constraint_true;
    $model->jump_constraint_false = $model->jump_json->jump_constraint_false;

    $model->mp3 = 0;
    $model->png = 0;
    $model->txt = 0;
    $model->type_question = 1;
    $model->id = rand(100000000, 999999999);

    if ($model->load(Yii::$app->request->post())) {
      if ($model->uploadFile('file_upload') != false) {
        $uploadFile = $model->uploadFile('file_upload');
        $uploadFile->saveAs('uploads/png/' . $model->id . '.png');

        $model->png = 1;
      }
      $model = $this->encodeModelWithArray($model, $this->choiceNames(), 'choices');
      $model = $this->encodeModelWithArray($model, $this->answerNames(), 'answers');
      $model = $this->encodeModelWithArray($model, $this->jumpChoiceName(), 'jump_choices');

      $model->jump_json->jump_type = $model->jump_type;
      $model->jump_json->jump_constraint = $model->jump_constraint;
      $model->jump_json->jump_score = $model->jump_score;
      $model->jump_json->jump_constraint_true = $model->jump_constraint_true;
      $model->jump_json->jump_constraint_false = $model->jump_constraint_false;

      $model->jump_json = json_encode($model->jump_json);

      $model->updated_at = date('Y-m-d H:i:s');

      $model->save();
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
                  'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing Question model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id) {
    $this->layout = 'main_backend';
    $model = $this->findModel($id);
    $model = $this->decodeModelWithArray($model, $this->choiceNames(), 'choices');
    $model = $this->decodeModelWithArray($model, $this->answerNames(), 'answers');
    $model = $this->decodeModelWithArray($model, $this->jumpChoiceName(), 'jump_choices');
    ($model->jump_json == '' || $model->jump_json == null) ? $model->jump_json = json_encode($this->setJsonJump()) : null;
    $model->jump_json = json_decode($model->jump_json);
    //
    $model->jump_type = $model->jump_json->jump_type;
    $model->jump_constraint = $model->jump_json->jump_constraint;
    $model->jump_score = $model->jump_json->jump_score;
    $model->jump_constraint_true = $model->jump_json->jump_constraint_true;
    $model->jump_constraint_false = $model->jump_json->jump_constraint_false;

    if ($model->load(Yii::$app->request->post())) {
      $model = $this->encodeModelWithArray($model, $this->choiceNames(), 'choices');
      $model = $this->encodeModelWithArray($model, $this->answerNames(), 'answers');
      $model = $this->encodeModelWithArray($model, $this->jumpChoiceName(), 'jump_choices');
      //
      $model->jump_json->jump_type = $model->jump_type;
      $model->jump_json->jump_constraint = $model->jump_constraint;
      $model->jump_json->jump_score = $model->jump_score;
      $model->jump_json->jump_constraint_true = $model->jump_constraint_true;
      $model->jump_json->jump_constraint_false = $model->jump_constraint_false;

      $model->jump_json = json_encode($model->jump_json);
      if ($model->uploadFile('file_upload') != false) {
        $uploadFile = $model->uploadFile('file_upload');
        $uploadFile->saveAs('uploads/png/' . $model->id . '.png');

        $model->png = 1;
      }
      $model->updated_at = date('Y-m-d H:i:s');

      $model->save();
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('update', [
                  'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Question model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
  public function actionDelete($id) {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * Finds the Question model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Question the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id) {
    if (($model = Question::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  private function decodeModelWithArray($model, $datas, $string) {
    $choice = json_decode($model->{$string});

    $choiceNames = $datas;
    $i = 1;
    foreach ($choiceNames as $name) {
      $model->{strval($name)} = $this->isEmptyData($choice, strval($i));
      $i++;
    }

    return $model;
  }

  private function encodeModelWithArray($model, $datas, $string) {
    $obj = [];
    $choiceNames = $datas;
    $i = 1;
    foreach ($choiceNames as $name) {
      $obj[strval($i)] = $model->{strval($name)};
      $i++;
    }

    $model->{$string} = json_encode($obj);

    return $model;
  }

  private function isEmptyData($object, $key) {
//    return $object->{$key};
    return (isset($object->{$key})) ? $object->{$key} : '';
//    return (isset($object->{$key}) && !empty($object->{$key}) ) ? $object->{$key} : '';
  }

  public function actionGetMissionTreeQuestion() {
    $stringQuestion = $_POST['questionTreeId'];
    $questions = explode(',', $stringQuestion);
    $models = Question::find()->where(['id' => $questions])->all();
    $arr = [];
    $count = 0;
    foreach ($models as $model) {
      $arr[$count]['id'] = $model->id;
      $arr[$count]['question_topic'] = $model->id;
      $arr[$count]['question'] = $model->id;
      $arr[$count]['part'] = $model->id;
      $arr[$count]['is_mission_tree'] = $model->id;
      $arr[$count]['mission_tree_questions'] = $model->id;
      $count++;
    }

    $newArr = json_encode($arr);
//    
    return json_encode($newArr);
  }

}
