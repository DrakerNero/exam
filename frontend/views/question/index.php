<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
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
                'width' => '20%',
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
                'label' => 'Updated',
                'attribute' => 'updated_at',
                'width' => '10px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ]
    ])
    ?>
    <?php
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
////            'question_number',
////            'question_name:ntext',
//            'type_question',
////            'choices_1:ntext',
//            // 'choices_2:ntext',
//            // 'choices_3:ntext',
//            // 'choices_4:ntext',
//            // 'choices_5:ntext',
//            // 'answer:ntext',
//            // 'answer_detail:ntext',
//            // 'mp3:ntext',
//            // 'image:ntext',
//            // 'txt:ntext',
//            // 'created',
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
    ?>

  </div>
</div>