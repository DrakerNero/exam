<?php

namespace frontend\widgets;

use frontend\models\QuestionSet;
use yii\web\View;
use kartik\grid\GridView;
use yii\helpers\Url;

class GridTableQuestion extends \yii\bootstrap\Widget {

  public $dataProvider;
  public $searchModel;
  public $updatePage;

  public function run() {
    $pngs = [1 => 'Yes', 0 => 'No'];

    echo GridView::widget([
        'dataProvider' => $this->dataProvider,
        'filterModel' => $this->searchModel,
        'hover' => true,
        'pjax' => true,
//          'showPageSummary' => true,
        'columns' => [
            [
                'label' => 'ID',
                'attribute' => 'id',
                'width' => '50px',
                'vAlign' => 'top',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Topic',
                'attribute' => 'question_topic',
                'width' => '700px',
                'vAlign' => 'top',
                'hAlign' => 'center',
                'contentOptions' => ['style' => 'text-align: left; '],
            ],
            [
                'label' => 'Question',
                'attribute' => 'question',
                'width' => '300px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'contentOptions' => ['style' => 'text-align: left;'],
            ],
            [
                'label' => 'Updated',
                'attribute' => 'updated_at',
                'width' => '10px',
                'vAlign' => 'top',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Max Choice',
                'attribute' => 'max_select_choice',
                'width' => '10px',
                'vAlign' => 'top',
                'hAlign' => 'center',
            ],
            [
                'label' => 'PNG',
                'attribute' => 'png',
                'width' => '10px',
                'vAlign' => 'top',
                'hAlign' => 'center',
                'filter' => $pngs,
                'value' => function($model) {

                  return ($model->png == 1) ? '<i class="fa fa-check _bg-green"></i>' : '<i  class="fa fa-times _bg-red"></i>';
                },
                'format' => 'html'
            ],
            ($this->updatePage == true) ? [
                'vAlign' => 'top',
                'hAlign' => 'center',
                'width' => '10px',
                'format' => 'html',
                'value' => function($model) {
                  return '<a target="_blank" href="' . Url::to(['question/update', 'id' => $model->id]) . '">'
                          . '<i class="fa fa-edit"></i>'
                          . '</a>';
                }
                            ] : [
                        'class' => 'yii\grid\ActionColumn',
                            ],
                ]
            ]);
          }

        }
        