<?php

namespace frontend\widgets;

use Yii;

class QuestionAudio extends \yii\bootstrap\Widget
{

    public $model;

    public function run()
    {
        $soundPart = Yii::$app->getUrlManager()->getBaseUrl() . '/uploads/mp3/';
        ?>

        <div class="ExamAudio">
            <audio controls id="">
                <source src="<?= $soundPart . "" . $this->model->id . '.mp3'; ?>" type="audio/ogg">
                <source src="<?= $soundPart . "" . $this->model->id . '.mp3'; ?>" type="audio/mpeg">
            </audio>
        </div>

        <?php
    }

}
