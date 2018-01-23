<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionSave */

$this->title = 'Update Question Save: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Question Saves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-save-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
