<?php

use yii\helpers\Url;
use frontend\helpers\MainHelper;
?>

<?php
if (!empty(Yii::$app->user->identity->userProfile->avatar)) {
  $url_image_profile = Yii::$app->user->identity->userProfile->avatar;
} else {
  $url_image_profile = Url::to('@frontendUrl/uploads/images/default_avatar_male.jpg');
}
?>

<div class="row" style="padding-left:15px; padding-right:15px;padding-top: 50px; ">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion glyphicon glyphicon-pushpin"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">จำนวนการส่งข้อสอบ</span>
        <span class="info-box-number"><?= $genCounrNumber ?> ชุด</span>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion glyphicon glyphicon-saved"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">จำนวนข้อสอบที่ผ่าน</span>
        <span class="info-box-number"><?= $countExamSuccess ?> ชุด</span>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Exam Activity Detail</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          <th>Exam</th>
          <th>Score</th>
          <th>Elapse Time</th>
          <th>Datetime</th>
        </tr>
        <?php
        $i = sizeof($models);
        foreach ($models as $model) {
          ?>
          <tr>
            <td><?= $model->questionset2->name ?></td>
            <td><?= (!empty($model->score) && isset($model->score)) ? $model->score . ' %' : '-' ?></td>
            <td><?= (!empty($model->elapse_time) && isset($model->elapse_time)) ? number_format($model->elapse_time / 60, 0) . ' min' : '-' ?></td>
            <td><?= MainHelper::setDateTimeThai(date('Y-m-d H:i:s',$model->updated_at)) ?></td>
          </tr>

          <?php
          $i--;
        }
        ?>

      </table>
    </div>
  </div>
</div>

<?php // echo NewQuestion::widget();?>

