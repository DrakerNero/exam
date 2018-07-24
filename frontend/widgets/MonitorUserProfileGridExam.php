<?php

namespace frontend\widgets;

use Yii;
use kartik\grid\GridView;
use frontend\helpers\MainHelper;
use yii\helpers\Url;

class MonitorUserProfileGridExam extends \yii\bootstrap\Widget {

  public $dataProvider;
  public $searchModel;

  public function run() {

    echo GridView::widget([
        'dataProvider' => $this->dataProvider,
        'filterModel' => $this->searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Topic',
                'attribute' => 'questionSet',
                'value' => 'questionSet.name',
            ],
            [
                'label' => 'Score(%)',
                'attribute' => 'score',
                'width' => '100px',
                'value' => function($model) {
                  return (!empty($model->score) && isset($model->score) && $model->score > 0) ? $model->score . '%' : 'Null';
                }
            ],
            [
                'label' => 'Status',
                'attribute' => 'status',
                'filter' => MainHelper::arrayQuestionSaveStatus(),
                'value' => function($model) {
                  return MainHelper::questionSaveStatus($model->status, $model->score);
                },
                'width' => '200px',
            ],
            [
                'label' => 'Last Update',
                'attribute' => 'updated_at',
//                'width' => '150px',
                'value' => function($model) {
                  return date('Y-m-d H:i:s', $model->updated_at);
                }
            ],
            [
                'width' => '1px',
                'format' => 'html',
                'value' => function($model) {
                  return (!empty($model->answer) && isset($model->answer) && $model->answer != null && $model->answer != '') ? '<a target="_blank" href="' . Url::to(['question-set/monitor-user-do-exam', 'questionSaveId' => $model->id]) . '"><i class="fa fa-external-link"></i></a>' : '';
//                  return '<a target="_blank" href="' . Yii::$app->getUrlManager()->getBaseUrl() . '/question-set/monitor-user-do-exam?questionSaveId=' . $model->id . '"><i class="fa fa-external-link"></i></a>';
                }
                    ],
                ],
            ]);
          }

        }
        