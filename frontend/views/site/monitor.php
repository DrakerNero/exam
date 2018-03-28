<?php

use yii\helpers\Url;
use frontend\widgets\MonitorTopTItle;
use frontend\widgets\QuestionSaveMonitorGridView;

$this->title = 'Chula Interactive Medical Case';
?>
<div class="site-index">
  <div class="row top_tiles">
    <?=
    MonitorTopTItle::widget([
        'icon' => 'fa-users',
        'count' => $userCount,
        'topic' => 'Users',
        'detail' => 'จำนวนผู้ใช้งานในระบบ',
    ])
    ?>
    <?=
    MonitorTopTItle::widget([
        'icon' => 'fa-comments-o',
        'count' => $examCount,
        'topic' => 'Exams',
        'detail' => 'จำนวนชุดข้อสอบในระบบ',
    ])
    ?>
    <?=
    MonitorTopTItle::widget([
        'icon' => 'fa-sort-amount-desc',
        'count' => $questionCount,
        'topic' => 'Questions',
        'detail' => 'จำนวนคำถามในระบบ',
    ])
    ?>
    <?=
    MonitorTopTItle::widget([
        'icon' => 'fa-check-square-o',
        'count' => $questionSaveCount,
        'topic' => 'Submitted',
        'detail' => 'จำนวนครั้งการทำข้อสอบรวมของนิสิต',
    ])
    ?>
  </div>

  <!--table-->


  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Dashboard1: List of Student </h2>
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
        <div class="row">
          <div class="col-lg-5 col-xs-5">
            <select id="input-academic-data" style="font-size: 14px;" class="form-control">
              <option disabled selected>Choose Academic Year...</option>
              <?php
              foreach ($resultAcademics as $academic) {
                echo '<option value="' . $academic . '">' . $academic . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-lg-5 col-xs-5">
            <select id="input-rotation-data" style="font-size: 14px;" class="form-control">
              <option disabled selected>Choose Rotation...</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div class="col-lg-2 col-xs-2">
            <span onclick="searchUserWithData('<?= Url::to(['site/monitor']) ?>')" style="font-size: 14px" class="btn btn-primary"><i class="fa fa-search"></i> Search</span>
          </div>
        </div>

        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <?=
              QuestionSaveMonitorGridView::widget([
                  'dataProvider' => $dataProvider,
                  'searchModel' => $searchUser
              ]);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



