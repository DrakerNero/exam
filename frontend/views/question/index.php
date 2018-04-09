<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use frontend\widgets\GridTableQuestion;
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
    <?= GridTableQuestion::widget(['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'updatePage'=> false]) ?>
    ?>

  </div>
</div>