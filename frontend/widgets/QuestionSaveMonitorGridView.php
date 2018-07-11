<?php

namespace frontend\widgets;

use Yii;
use kartik\grid\GridView;
use frontend\helpers\MainHelper;
use yii\helpers\Url;
use frontend\models\Rotation;

class QuestionSaveMonitorGridView extends \yii\bootstrap\Widget {

  public $dataProvider;
  public $searchModel;
  public $examCount;

  public function run() {
    $arrRotation = [0 => ''];
    $rotations = Rotation::find()->all();
    foreach ($rotations as $rotation) {
      $arrRotation[$rotation->id] = $rotation->name;
    }
    echo GridView::widget([
        'dataProvider' => $this->dataProvider,
        'filterModel' => $this->searchModel,
        'columns' => [
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
                'label' => 'Question Success',
                'contentOptions' => ['style' => 'text-align: center;'],
                'width' => '50px',
                'value' => function($model) {
          return count($model->userQuestionScore) . '/' . $this->examCount;
        }
            ],
            [
                'attribute' => 'start_study',
                'value' => 'start_study',
                'width' => '50px',
                'label' => 'Academic Year',
                'filter' => false,
//                'align'=>'center',
                'contentOptions' => ['style' => 'text-align: center;']
            ],
            [
                'attribute' => 'rotation',
                'value' => 'rotation',
                'width' => '50px',
                'label' => 'Rotation',
                'filter' => $arrRotation,
                'value' => function($model) {
                  return (!empty($model->myRotation) && isset($model->myRotation) && $model->myRotation->name != null && $model->myRotation->name != '' ) ? $model->myRotation->name : '-';
                },
                'contentOptions' => ['style' => 'text-align: center;']
            ],
            [
                'width' => '1px',
                'format' => 'html',
                'value' => function($model) {

                  return '<a target="_blank" href="' . Url::to(['site/monitor-profile-user', 'userId' => $model->id]) . '"><i class="fa fa-user"></i></a>';
                }
                    ],
                ],
                    ], ['examCount' => $this->examCount]);
          }

        }
        