<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProfileStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .glyphicon.glyphicon-eye-open {
    display: none;
  }
</style>
<div class="profile-student-index">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
          <?= Html::a('Create Profile Student', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <?=
              GridView::widget([
                  'dataProvider' => $dataProvider,
                  'filterModel' => $searchModel,
                  'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                      'student_id',
                      'first_name',
                      'last_name',
                      [
                          'attribute' => 'start_study',
                          'width' => '80px',
                          'contentOptions' => ['style' => 'text-align: center; vertical-align: top;'],
                      ],
                      [
                          'label' => 'Rotation',
                          'attribute' => 'rotation',
                          'width' => '80px',
                          'contentOptions' => ['style' => 'text-align: center; vertical-align: top;'],
                      ],
                      [
                          'label' => 'Register',
                          'attribute' => 'first_login',
                          'value' => function($model) {
                            return ($model->first_login == 1) ? '<i class="fa fa-check _bg-green"></i>' : '<i  class="fa fa-times _bg-red"></i>';
                          },
                          'format' => 'html',
                          'contentOptions' => ['style' => 'text-align: center; vertical-align: top;'],
                          'width' => '80px',
                      ],
                      //'created_at',
                      //'updated_at',
                      //'active',
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