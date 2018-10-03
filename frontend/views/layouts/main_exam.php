
<?php

use yii\helpers\BaseUrl;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\widgets\HeaderBar;
use yii\helpers\Html;

/* var $this \yii\web\View */
?>
<?php $this->beginContent('@frontend/views/layouts/base.php'); ?>
<div class="wrapper" id="page-exam" onbeforeunload="return SaveTime()" >

    <?= HeaderBar::widget(); ?>
    <!-- Left side column. contains the logo and sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content" id="backgroundDoExam">
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

            <?= $content ?>


        </section><!-- /.content -->
        <footer>
        </footer>
    </div><!-- /.content-wrapper -->
</div><!-- /.content-wrapper -->

<?php $this->endContent(); ?>
