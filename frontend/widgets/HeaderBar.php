<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Url;
use frontend\widgets\HeartRate;

class HeaderBar extends \yii\bootstrap\Widget {

  public $from;
  public $to;

  public function run() {
    ?>
    <div class="frameHeader">
      <header class="main-header" id="divHeaderBar" >
        <!-- Logo -->
        <a href="<?= Url::to('@frontendUrl') ?>" onClick="return SaveState(2)" class="logo" id="mainLogo" >
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini" ><b>ePT</b></span>
          <!-- logo for regular state and mobile devices -->
          <?= HeartRate::widget() ?>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" id="navBarTopMenu" role="navigation">
          <div class="mini-header">
            <a href="<?php echo Yii::getAlias('@frontendUrl') ?>" onClick="return SaveState(2)" class="logo">
              <?= HeartRate::widget() ?>
                <!--<img src="<?= Url::to('@frontendUrl/uploads/images/logo.png') ?>" class="img-circle" />-->
            </a>
          </div>
          <div class="frame-submit-mobile">
            <div class="div-submit-exam-mobile" id="insert-answer" onclick="return SaveState(3)">
              Submit
            </div>
            <div class="div-rescore-exam-mobile" id="insert-rescore">
              ทำใหม่
            </div>
          </div>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
    </div>
    <?php
  }

}
