<?php

namespace backend\controllers;

use Yii;
use backend\models\QuestionSave;
use backend\models\QuestionSaveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionSaveController implements the CRUD actions for QuestionSave model.
 */
class QuestionSaveController extends Controller
{
    public function behaviors()
    {
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
     * Lists all QuestionSave models.
     * @return mixed
     */
    public function actionIndex()
    {
       $searchModel = new QuestionSaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if (Yii::$app->request->post('hasEditable')) 
        { 
            $id = Yii::$app->request->post('editableKey');            
            $model = QuestionSave::findOne($id);
            $post = [];
        
           // $out = Json::encode(['output'=>'', 'message'=>'']); 
            $posted = current($_POST['QuestionSave']);
             $post['QuestionSave'] = $posted;

            if ($model->load($post)) {           
                $model->save();
           }      
            echo $id;
         return; 
        }
      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReport()
    {
        $models = QuestionSave::find()->where(['status' => 3])->all();
        if(isset($_GET['from_date']))
        {
            $from_date = date("U", strtotime($_GET['from_date']));
            $to_date = date("U", strtotime($_GET['to_date']));          
            $models = QuestionSave::find()     
                ->where(['status' => 3])       
                ->andWhere(['between', 'created_at',  $from_date,$to_date])
                ->all();
        }
        return $this->render('report',['models' => $models]);
    }

    /**
     * Displays a single QuestionSave model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new QuestionSave model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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
    public function actionUpdate($id)
    {
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = QuestionSave::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
