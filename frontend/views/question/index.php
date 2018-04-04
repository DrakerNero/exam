<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
$pngs = [1 => 'Yes', 0 => 'No'];
?>
<div class="question-index">


  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <div class="x_panel">

    <p>
      <?= Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover' => true,
        'pjax' => true,
//          'showPageSummary' => true,
        'columns' => [
            [
                'label' => 'ID',
                'attribute' => 'id',
                'width' => '50px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Topic',
                'attribute' => 'question',
                'width' => '1300px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'contentOptions' => ['style' => 'text-align: left;'],
            ],
            [
                'label' => 'Updated',
                'attribute' => 'updated_at',
                'width' => '10px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Max Choice',
                'attribute' => 'max_select_choice',
                'width' => '10px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
            ],
            [
                'label' => 'PNG',
                'attribute' => 'png',
                'width' => '10px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'filter' => $pngs,
                'value' => function($model) {
                  return ($model->png == 1) ? '<i class="fa fa-check _bg-green"></i>' : '<i  class="fa fa-times _bg-red"></i>';
                },
                'format' => 'html'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ]
    ])
    ?>

  </div>
</div>