<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Subject */

$this->title = 'Create Subject';
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
