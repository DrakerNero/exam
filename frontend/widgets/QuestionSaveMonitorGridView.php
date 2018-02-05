<?php

namespace frontend\widgets;

use Yii;
use kartik\grid\GridView;
use frontend\helpers\MainHelper;
use yii\helpers\Url;

class QuestionSaveMonitorGridView extends \yii\bootstrap\Widget {

  public $dataProvider;
  public $searchModel;

  public function run() {

    echo GridView::widget([
        'dataProvider' => $this->dataProvider,
        'filterModel' => $this->searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'student_id',
                'value' => 'student_id',
                'width' => '90px',
            ],
            [
                'label' => 'First Name',
                'attribute' => 'first_name',
                'value' => 'first_name',
            ],
            [
                'label' => 'Last Name',
                'attribute' => 'last_name',
                'value' => 'last_name',
//                'width' => '100px',
            ],
            [
                'attribute' => 'faculty',
                'value' => 'faculty',
                'width' => '50px',
            ],
            [
                'attribute' => 'branch',
                'value' => 'branch',
                'width' => '50px',
            ],
            [
                'attribute' => 'start_study',
                'value' => 'start_study',
                'width' => '50px',
            ],
//            [
//                'label' => 'Topic',
//                'attribute' => 'questionSet',
//                'value' => 'questionSet.name',
//            ],
//            [
//                'label' => 'Score',
//                'attribute' => 'score',
////                'width' => '100px',
//            ],
//            [
//                'label' => 'Status',
//                'attribute' => 'status',
//                'filter' => MainHelper::arrayQuestionSaveStatus(),
//                'value' => function($model) {
//                  return MainHelper::arrayQuestionSaveStatus()[$model->status];
//                },
//                'width' => '50px',
//            ],
//            [
//                'label' => 'Updated',
//                'attribute' => 'updated_at',
//                'value' => function($model) {
//                  return date('Y-m-d H:i:s', $model->updated_at);
//                }
//            ],
//            [
//                'width' => '1px',
//                'format' => 'html',
//                'value' => function($model) {
//                  return '';
////                  return '<a target="_blank" href="' . Yii::$app->getUrlManager()->getBaseUrl() . '/question-set/monitor-user-do-exam?questionSaveId=' . $model->id . '"><i class="fa fa-edit"></i></a>';
//                }
//            ],
            [
                'width' => '1px',
                'format' => 'html',
                'value' => function($model) {

                  return '<a target="_blank" href="' . Url::to(['site/monitor-profile-user', 'userId' => $model->id]) . '"><i class="fa fa-user"></i></a>';
                }
                    ],
                ],
            ]);
          }

        }
        