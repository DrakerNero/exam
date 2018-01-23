<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSave */

$this->title = 'Create Question Save';
$this->params['breadcrumbs'][] = ['label' => 'Question Saves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-save-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
