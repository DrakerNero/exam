<?php

namespace frontend\widgets;

use yii\web\View;

class BtnInsertAnswer extends \yii\bootstrap\Widget
{

    public $from;
    public $to;

    public function run()
    {
//        $appendText = '<input type="button" value="Submit" class="insertAnswer" onclick="InsertQuestion(' . $this->from . ',' . $this->to . ' )">';
//        $appendText = '<a><div class="insertAnswer" >Submit <i class="fa fa-check"></i></div></a>';
//        $js = "
//            function BtnInsertAnswer() {
//                $('.loadBtnInsert').append('{$appendText}');
//
//            }
//            BtnInsertAnswer();
//        ";
//
//        $this->view->registerJs($js, View::POS_READY);
    }

}
