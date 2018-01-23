<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSet */

$this->title = 'Create Question Set';
$this->params['breadcrumbs'][] = ['label' => 'Question Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-set-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
