<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Mains';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .glyphicon.glyphicon-eye-open {
    display: none;
  }
</style>
<div class="user-main-index">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <?=
              GridView::widget([
                  'dataProvider' => $dataProvider,
                  'filterModel' => $searchModel,
                  'class' => 'grid-view hide-resize',
                  'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                      'username',
                      'student_id',
                      'first_name',
                      'last_name',
                      'start_study',
                      'rotation',
                      ['class' => 'yii\grid\ActionColumn'],
                  ],
              ]);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

