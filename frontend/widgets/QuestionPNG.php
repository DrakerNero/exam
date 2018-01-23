<?php

namespace frontend\widgets;

use yii;

class QuestionPNG extends \yii\bootstrap\Widget
{

    public $model;

    public function run()
    {
        ?>

        <div class="position-quesiton-image">
            <img src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/uploads/png/<?= $this->model->id ?>.png" />
        </div>

        <?php
    }

}
