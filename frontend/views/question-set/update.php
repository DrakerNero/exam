<?php

//use Yii;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use frontend\widgets\GridTableQuestion;

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
      <?= GridTableQuestion::widget(['dataProvider' => $dataProvider, 'searchModel' => $questionSearch ,'updatePage'=> true]) ?>
    </div>
  </div>

</div>
