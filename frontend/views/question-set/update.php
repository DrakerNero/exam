<?php

//use Yii;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionSet */

$this->title = 'Update Question Set: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Question Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-set-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?=
  $this->render('_form', [
      'model' => $model,
      'questions' => $questions,
  ])
  ?>


  <div class="wrapper-question-set-lock-question">
    <div class="wrapper-btn-question">
      <div class="btn-click-toggle" onclick="handleClickToggleClassActive('wrapper-question-set-lock-question')">
        <i class="fa fa-share-square-o"></i>
      </div>
    </div>
    <div class="wrapper-question-seach">
      <?=
      GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $questionSearch,
          'hover' => true,
          'pjax' => true,
//          'showPageSummary' => true,
          'columns' => [
              [
                  'label' => 'ID',
                  'attribute' => 'id',
                  'width' => '20%',
                  'vAlign' => 'middle',
                  'hAlign' => 'center',
              ],
              [
                  'label' => 'Part',
                  'attribute' => 'part',
                  'width' => '20px',
                  'vAlign' => 'middle',
                  'hAlign' => 'center',
              ],
              [
                  'label' => 'Topic',
                  'attribute' => 'question',
                  'width' => '65%',
                  'vAlign' => 'middle',
                  'hAlign' => 'center',
              ],
              [
                  'label' => 'Answer',
                  'attribute' => 'answer',
                  'width' => '10px',
                  'vAlign' => 'middle',
                  'hAlign' => 'center',
              ],
              [
                  'label' => 'Image',
                  'attribute' => 'png',
                  'width' => '10px',
                  'vAlign' => 'middle',
                  'hAlign' => 'center',
              ],
              [
                  'vAlign' => 'middle',
                  'hAlign' => 'center',
                  'width' => '10px',
                  'format' => 'html',
                  'value' => function($model) {
                    return '<a target="_blank" href="' . Url::to(['question/update', 'id' => $model->id]) . '">'
                            . '<i class="fa fa-edit"></i>'
                            . '</a>';
//                    return '<a target="_blank" href="' . Yii::$app->getUrlManager()->getBaseUrl() . '/question/update?id=' . $model->id . '">'
//                            . '<i class="fa fa-edit"></i>'
//                            . '</a>';
                  }
                      ],
                  ]
              ])
              ?>
    </div>
  </div>

</div>
