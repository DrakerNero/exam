<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionSet */

$this->title = 'Create Question Set';
$this->params['breadcrumbs'][] = ['label' => 'Question Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-set-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
