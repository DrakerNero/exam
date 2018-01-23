<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionSave */

$this->title = 'Create Question Save';
$this->params['breadcrumbs'][] = ['label' => 'Question Saves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-save-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
