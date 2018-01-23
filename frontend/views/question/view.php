<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Question */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-view">

  <h1><?= Html::encode($this->title) ?></h1>
  <div class="x_panel">

    <p>
      <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?=
      Html::a('Delete', ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'data' => [
              'confirm' => 'Are you sure you want to delete this item?',
              'method' => 'post',
          ],
      ])
      ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'question_number',
//            'question_name:ntext',
            'type_question',
            'choices',
//            'choices_2:ntext',
//            'choices_3:ntext',
//            'choices_4:ntext',
//            'choices_5:ntext',
            'answer:ntext',
            'answer_detail:ntext',
            'mp3:ntext',
            'png:ntext',
            'txt:ntext',
            'updated_at',
        ],
    ])
    ?>
  </div>
</div>
