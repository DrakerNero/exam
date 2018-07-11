<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Rotation */

$this->title = 'Create Rotation';
$this->params['breadcrumbs'][] = ['label' => 'Rotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rotation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
