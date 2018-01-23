<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSet */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Question Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-set-view">

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
            'subject_id',
            'name',
            'explanation:ntext',
            'from',
            'to',
            'total_time:datetime',
            'total_score',
            'question_type',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
