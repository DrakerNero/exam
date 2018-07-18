<?php

namespace frontend\widgets;

use yii\helpers\Url;

class SideBarMenuList extends \yii\bootstrap\Widget {

  public function run() {
    ?>

    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="<?= Url::to(['site/monitor']) ?>"><i class="fa fa-home"></i> Dashboard </a></li>
          <li><a><i class="fa fa-file-text"></i> Exam <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?= Url::to(['question-set/index']) ?>">View</a></li>
              <li><a href="<?= Url::to(['question-set/create']) ?>">Create</a></li>
              <!--<li><a href="#">Excel Upload</a></li>-->
            </ul>
          </li>
          <li><a><i class="fa fa-question-circle"></i> Question <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?= Url::to(['question/index']) ?>">View</a></li>
              <li><a href="<?= Url::to(['question/create']) ?>">Create</a></li>
              <!--<li><a href="#">Excel Upload</a></li>-->
            </ul>
          </li>
          <li><a><i class="fa fa-graduation-cap"></i> Students <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?= Url::to(['user-main/index']) ?>">All</a></li>
              <li><a href="<?= Url::to(['question/create']) ?>">Active</a></li>
              <!--<li><a href="#">Excel Upload</a></li>-->
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <?php
  }

}
