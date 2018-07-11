<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rotations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="rotation-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
          <?= Html::a('Create Rotation', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'name',
                'active',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
      </div>
    </div>
  </div>
</div>
