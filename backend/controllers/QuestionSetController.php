<?php

namespace backend\controllers;

use Yii;
use backend\models\QuestionSet;
use backend\models\QuestionSetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionSetController implements the CRUD actions for QuestionSet model.
 */
class QuestionSetController extends Controller
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
     * Lists all QuestionSet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if (Yii::$app->request->post('hasEditable')) 
        { 
            $id = Yii::$app->request->post('editableKey');            
            $model = QuestionSet::findOne($id);
            $post = [];
        
           // $out = Json::encode(['output'=>'', 'message'=>'']); 
            $posted = current($_POST['QuestionSet']);
             $post['QuestionSet'] = $posted;

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

    /**
     * Displays a single QuestionSet model.
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
     * Creates a new QuestionSet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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
     * Deletes an existing QuestionSet model.
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
     * Finds the QuestionSet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionSet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionSet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
