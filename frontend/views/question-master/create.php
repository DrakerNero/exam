<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionMaster */

$this->title = 'Create Question Master';
$this->params['breadcrumbs'][] = ['label' => 'Question Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
