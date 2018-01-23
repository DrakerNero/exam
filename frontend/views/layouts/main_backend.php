<?php

use yii\helpers\Html;
use frontend\assets\AssetBackendLayout;
use frontend\widgets\SideBar;

AssetBackendLayout::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html  lang="<?= Yii::$app->language ?>">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  </head>

  <body class="nav-md" id="main-backend">
    <?php $this->beginBody() ?>
    <div class="container body">
      <div class="main_container">
        <?= SideBar::widget() ?>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu" style="height: 59px;">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row tile_count"></div>
          <div class="row">
            <?= $content ?>
          </div>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Chula Interactive Medical Case
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>