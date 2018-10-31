<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset2::register($this);
//\backend\assets\BackendAsset::register($this);
$this->params['body-class'] = array_key_exists('body-class', $this->params) ?
        $this->params['body-class'] : null;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <?php echo Html::csrfMetaTags() ?>
        <title>CU Interactive Medical Cases</title>
        <?php $this->head() ?>

    </head>
    <?php
    echo Html::beginTag('body', [
        'class' => implode(' ', [
            ArrayHelper::getValue($this->params, 'body-class'),
            Yii::$app->keyStorage->get('backend.theme-skin', 'skin-blue'),
            Yii::$app->keyStorage->get('backend.layout-fixed') ? 'fixed' : null,
            Yii::$app->keyStorage->get('backend.layout-boxed') ? 'layout-boxed' : null,
            Yii::$app->keyStorage->get('backend.layout-collapsed-sidebar') ? 'sidebar-collapse' : null,
        ])
    ])
    ?>
    <?php $this->beginBody() ?>
    <?php echo $content ?>
    <?php $this->endBody() ?>
    <?php echo Html::endTag('body') ?>
    <!-- <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://www.e-studio.co.th">E-Studio Co., ltd. </a>.</strong> All rights reserved.
    </footer> -->
</html>
<?php $this->endPage() ?>
