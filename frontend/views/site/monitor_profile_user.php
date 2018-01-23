<?php

use frontend\widgets\MonitorUserProfileGridExam;
use frontend\widgets\QuestionSaveMonitorGridView;
use frontend\widgets\ProgressExamUser;
use yii\helpers\Url;

$fullName = $user->userProfile->firstname . ' ' . $user->userProfile->lastname;
$this->title = 'Report by ' . $fullName;
?>

<div class="x_panel">
  <div class="x_title">
    <h2>Student Activity Report</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Settings 1</a>
          </li>
          <li><a href="#">Settings 2</a>
          </li>
        </ul>
      </li>
      <li><a class="close-link"><i class="fa fa-close"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
      <div class="profile_img">
        <div id="crop-avatar">
          <!-- Current avatar -->
          <img class="img-responsive avatar-view" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/uploads/static/doctor-1.png" alt="Avatar" title="Change the avatar">
        </div>
      </div>
      <h3><?= $fullName ?></h3>
      <ul class="list-unstyled user_data">
        <li>
          <h4><i class="fa fa-bookmark"></i> <?= $user->first_name . '  ' . $user->last_name ?></h4>
        </li>

        <li>
          <i class="fa fa-briefcase user-profile-icon"></i> <?= $user->branch ?>
        </li>

      </ul>

      <a href="<?= Url::to(['site/edit-profile-user', 'id' => $userId]) ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
      <br>

      <!-- start skills -->
      <h4>Exam</h4>
      <ul class="list-unstyled user_data">
        <?php
        foreach ($questionSets as $questionSet) {
          echo ProgressExamUser::widget(['questionSet' => $questionSet, 'userId' => $userId]);
        }
        ?>
      </ul>
      <!-- end of skills -->

    </div>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <?=
      MonitorUserProfileGridExam::widget([
          'dataProvider' => $dataProvider,
          'searchModel' => $searchModel
      ])
      ?>
    </div>
  </div>
</div>