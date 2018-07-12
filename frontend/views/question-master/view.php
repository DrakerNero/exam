<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionMaster */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Question Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'topic',
            'name',
            'question_sets:ntext',
            'active',
            'created_at',
            'updated_at',
            'total_time:datetime',
            'multi_select_choice',
            'mode',
        ],
    ]) ?>

</div>
