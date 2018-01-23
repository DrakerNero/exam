<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSave */

$this->title = 'Update Question Save: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Question Saves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-save-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
