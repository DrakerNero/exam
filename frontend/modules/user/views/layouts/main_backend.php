<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>

<?php $this->beginPage() ?>
<?php $this->beginContent('@frontend/views/layouts/main_backend.php'); ?>

<?= $content; ?>

<?php $this->endContent(); ?>
<?php $this->endPage() ?>
