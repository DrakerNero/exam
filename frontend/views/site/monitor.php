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
        'icon' => 'fa-check-square-o',
        'count' => $userCount,
        'topic' => 'จำนวนผู้ส่งข้อสอบ',
        'detail' => 'ที่ผ่านมากกว่า 80%',
    ])
    ?>
    <?=
    MonitorTopTItle::widget([
        'icon' => 'fa-sort-amount-desc',
        'count' => count($modelUsersSummit),
        'topic' => 'จำนวนผู้ส่งข้อสอบ',
        'detail' => 'ตามการค้นหา',
    ])
    ?>
    <?=
    MonitorTopTItle::widget([
        'icon' => 'fa-users',
        'count' => $countUserActive,
        'topic' => 'Total Student',
        'detail' => 'จำนวนนิสิตที่เข้าใช้งานระบบทั้งหมด',
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
//              $count = 1;
              foreach ($resultAcademics as $resultAcademic) {
                $selected = ($resultAcademic == $academic) ? 'selected' : '';
                echo '<option value="' . $resultAcademic . '" ' . $selected . '>' . $resultAcademic . '</option>';
//                $count++;
              }
              ?>
            </select>
          </div>
          <div class="col-lg-5 col-xs-5">
            <select id="input-rotation-data" style="font-size: 14px;" class="form-control">
              <option disabled selected>Choose Rotation...</option>
              <?php
              for ($i = 1; $i <= 3; $i++) {
                $selected2 = ($i == $rotation) ? 'selected' : '';
                echo '<option value="' . $i . '" ' . $selected2 . '>' . $i . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-lg-2 col-xs-2">
            <span onclick="searchUserWithData('<?= Url::to(['site/monitor']) ?>', 'false')" style="font-size: 14px" class="btn btn-primary"><i class="fa fa-search"></i> Search</span>
            <span onclick="searchUserWithData('<?= Url::to(['question-save/question-save-export-excel-with-user']) ?>', 'true')" style="font-size: 14px" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Export</span>
          </div>
        </div>

        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <?=
              QuestionSaveMonitorGridView::widget([
                  'dataProvider' => $dataProvider,
                  'searchModel' => $searchUser,
                  'examCount'=>$examCount,
              ]);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



