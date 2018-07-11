<?php

namespace frontend\widgets;

use Yii;
use frontend\widgets\SideBarMenuList;
use yii\helpers\Url;

class SideBar extends \yii\bootstrap\Widget {

  public function run() {
    ?>

    <div class="col-md-3 left_col" id="backend-side-bar">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">

          <a href="<?= Url::to(['site/index']) ?>" class="site_title">
            <img src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/uploads/static/logo-2.png" alt="" class="logo-backend">
            <span>Administor</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
          <div class="wrapper-icon-user">
            <i class="fa fa-user-md"></i> 
          </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <?= SideBarMenuList::widget() ?>
      </div>
    </div>

    <?php
  }

}
