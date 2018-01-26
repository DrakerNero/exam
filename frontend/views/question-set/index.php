<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuestionSetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Sets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-set-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <div class="x_panel">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
      <?= Html::a('Create Question Set', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'from',
            'to',
            'total_time',
            'total_score',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{copy}',
                'contentOptions' => [ 'width' => '1px'],
                'header' => '',
                'buttons' => [
                    'copy' => function($url, $model, $key) {
                      return '<a target="_blank" href="' . Url::to(['question-set/print-file-exam', 'id' => $model->id]) . '"><i class="fa fa-print"></i></a>';
                    },
                        ],
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

  </div>
</div>
