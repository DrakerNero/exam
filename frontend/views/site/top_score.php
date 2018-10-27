<?php

use frontend\helpers\MainHelper;
use yii\helpers\Url;

function handleEmpty($data) {
  return (!empty($data) && isset($data) && $data != null) ? $data : '-';
}
?>
<div class="row" id="wrapper-module-exam">
    <div class="wrapper-top-score">
        <div class="row">
            <div class="col-lg-6" style="text-align: left; margin-bottom: 20px;">

            </div>
            <div class="col-lg-6" style="text-align: right">
                <h3>Hello &nbsp;&nbsp; <?= $user->first_name . ' ' . $user->last_name ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="custom-select" >
                    <select id="select-question-top-score">
                      <?php
                      foreach ($questionSets as $questionSet) {
                        $select = '';
                        if ($questionSetId == $questionSet->id) {
                          $select = 'selected';
                          $questionName = $questionSet->name;
                        } else {
                          
                        }
//              $select = ($questionSetId == $questionSet->id) ? 'selected' : '';
                        echo '<option value="' . $questionSet->id . '" ' . $select . '>' . $questionSet->name . '</option>';
                      }
                      ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <button onClick="goToToScoreWihtId('<?= Url::to(['site/top-score', 'questionSetId' => '']) ?>');" type="button" class="btn btn-success" style="height: 40px;"><i class="fa fa-send"></i></button>
            </div>
        </div>
        <br />
        <div class="box box-info" style="padding: 10px;">
            <h2> Student complete: <?= $questionName ?></h2>
            <br />
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Academic Year</th>
                        <th>Rotation</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($models as $model) {
                    $handleRotation = (!empty($model->user->rotation) && isset($model->user->rotation) && $model->user->rotation != null) ? MainHelper::setLotation()[$model->user->rotation] : '-';
                    ?>

                      <tr>
                          <td> <?= handleEmpty($model->user->username) ?> </td>
                          <td> <?= handleEmpty($model->user->first_name) ?> </td>
                          <td> <?= handleEmpty($model->user->last_name) ?> </td>
                          <td> <?= handleEmpty($model->user->start_study) ?> </td>
                          <td> <?= $handleRotation ?> </td>
                      </tr>
                      <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>