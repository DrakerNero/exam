<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserMain */
?>
<style>
  .form-group.field-usermain-status {
    display: none;
  }
  
</style>
<div class="row" id="wrapper-module-exam">

  <div class="user-main-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
  </div>

</div>
