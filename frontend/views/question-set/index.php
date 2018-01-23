<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
//            'explanation:ntext',
            'name',
            'from',
            'to',
            'total_time',
            'total_score',
            // 'question_id:ntext',
            // 'img',
            // 'status',
            // 'created',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

  </div>
</div>
