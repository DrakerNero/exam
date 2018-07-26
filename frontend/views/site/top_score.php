<?php

use frontend\helpers\MainHelper;
?>
<div class="row" id="wrapper-module-exam">
  <div class="wrapper-top-score">
    <div class="row">
      <div class="col-lg-8">
        <div class="custom-select" >
          <select id="select-question-top-score">
            <?php
            foreach ($questionSets as $questionSet) {
              $select = ($questionSetId == $questionSet->id) ? 'selected' : '';
              echo '<option value="' . $questionSet->id . '" ' . $select . '>' . $questionSet->name . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-lg-4">
        <button onClick="goToToScoreWihtId('<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/..');" type="button" class="btn btn-success" style="height: 40px;"><i class="fa fa-send"></i></button>
      </div>
    </div>
    <br />
    <div class="box box-info" style="padding: 10px;">
      <h2>Top Score</h2>
      <br />
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Academic Year</th>
            <th>Rotation</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($models as $model) {
            ?>

            <tr>
              <td> <?= $model->user->first_name ?> </td>
              <td> <?= $model->user->last_name ?> </td>
              <td> <?= $model->user->start_study ?> </td>
              <td> <?= MainHelper::setLotation()[$model->user->rotation] ?> </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>