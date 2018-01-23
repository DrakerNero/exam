<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSet */

$this->title = 'Update Question Set: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Question Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-set-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
