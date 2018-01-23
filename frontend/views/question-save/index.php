<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuestionSaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Saves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-save-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Question Save', ['create' ], ['class' => 'btn btn-success' ]) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn' ],
            'id',
            'question_set_id',
            'score',
            [
                'label' => 'นายจ้าง',
                'attribute' => 'employer_id',
                'width' => '300px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function($model) {
                }
            ],
//            'user_id',
//            'question_type',
//            'answer:ntext',
            // 'time',
            // 'status',
            // 'updated',
            ['class' => 'yii\grid\ActionColumn' ],
        ],
    ]);
    ?>

</div>
