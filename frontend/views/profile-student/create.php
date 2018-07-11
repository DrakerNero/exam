<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ProfileStudent */

$this->title = 'Create Profile Student';
$this->params['breadcrumbs'][] = ['label' => 'Profile Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
