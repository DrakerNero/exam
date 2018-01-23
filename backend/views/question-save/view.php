<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSave */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Question Saves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-save-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'question_set_id',
            'user_id',
            'mode',
            'answer:ntext',
            'score',
            'elapse_time:datetime',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
