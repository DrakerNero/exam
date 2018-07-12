<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuestionMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Question Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'topic',
            'name',
            'question_sets:ntext',
            'active',
            //'created_at',
            //'updated_at',
            //'total_time:datetime',
            //'multi_select_choice',
            //'mode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
