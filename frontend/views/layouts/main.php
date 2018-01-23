<?php

use backend\assets\BackendAsset;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\web\View;
use yii\bootstrap\Modal;
use frontend\widgets\HeaderMenuLeft;
use frontend\models\User;

/* @var $this \yii\web\View */

if (!empty(Yii::$app->user->identity->id)) {
  $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
} else {
  $user = "";
}
?>
<?php $this->beginContent('@frontend/views/layouts/base.php'); ?>
<link href="<?= Url::to('@frontendUrl/uploads/images/e-pretest-touch-icon.png') ?>" sizes="120x120" rel="apple-touch-icon" />
<div class="wrapper">
  <header class="main-header" id="divHeaderBar">
    <a href="<?php echo Yii::getAlias('@frontendUrl') ?>" class="logo">
        <!--<img src="<?= Url::to('@frontendUrl/uploads/images/logo.png') ?>" class="img-circle" />-->
        <!--<span>e-pretest</span>-->
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?php echo Yii::t('frontend', 'Toggle navigation') ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="text-header">
<!--                <span>คลังข้อสอบออนไลน์</span>-->
      </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <?php
            if (Yii::$app->user->isGuest) {
              ?>
              <a href="<?= Yii::$app->urlManager->createUrl(['user/auth/login']) ?>">เข้าสู่ระบบ</a>
            </li>
            <?php
          } else {
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php
              $part_image = Yii::$app->user->identity->userProfile->avatar;

              if ($part_image != null) {
                ?>
                <img src="<?= $part_image ?>" class="user-image">
                <?php
              } else {
                ?>
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              <?php } ?>
              <br>
            </a>
            <ul class="dropdown-menu" style="width:20%">
              <li><a href="<?= Url::to(['question-save/history']) ?>"><font color="#000">Dashboard</font></a></li>
              <?php
              if (!empty(Yii::$app->user->identity->id)) {
                if ($user->user_status == 1) {
                  ?>
                  <!--<li><a href="<?= Url::to(['question-save/monitor', 'email' => '0']) ?>"><font color="#000">Search EXAM by User</font></a></li>-->
                  <li><a href="<?= Url::to(['site/monitor']) ?>"><font color="#000">Administor</font></a></li>
                  <?php
                } else {
                  
                }
              } else {
                
              }
              ?>
              <li><a href="<?= Url::to(['user/auth/logout']) ?>"><font color="#000">Log Out</font></a></li>
            </ul>
          <?php } ?>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <?= HeaderMenuLeft::widget() ?>

  <aside class="content-wrapper">
    <section class="content main-content">
      <?php if (Yii::$app->session->hasFlash('alert')): ?>
        <?php $this->registerJs('$("#flashMessage").modal("show")', VIEW::POS_READY); ?>
        <?php
        Modal::begin([
            'id' => 'flashMessage',
            'header' => '<h2>' . ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'title') . '</h2>',
        ]);

        echo ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body');

        Modal::end();
        ?>
        <?php /* echo \yii\bootstrap\Alert::widget([
          'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
          'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
          ]) */ ?>
      <?php endif; ?>
      <?php echo $content ?>

    </section>
    <footer>
    </footer>
  </aside>
</div>


<?php $this->endContent(); ?>
