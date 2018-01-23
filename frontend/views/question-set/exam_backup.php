<?php

use frontend\models\QuestionSet;
use frontend\widgets\LoadViewQuestion;
use frontend\widgets\HeaderMenuLeft;
use frontend\widgets\HeaderMenuRight;
use frontend\widgets\BottomMenuCenter;

//use frontend\widgets\HeaderBar;
//print_r($model);


$this->title = 'Chula Interactive Medical Case';

$i = 0;
foreach ( $questionSet as $questionID )
{
    $i++;
    $question = QuestionSet::LoadQuestion($questionID);
    echo LoadViewQuestion::widget(['question' => $question, 'countDiv' => $i ]);
}
echo HeaderMenuLeft::widget();
echo HeaderMenuRight::widget(['countQuestion' => $i, 'questionSet' => $questionSet ]);
echo BottomMenuCenter::widget(['countQuestion' => $i, 'questionSet' => $questionSet ]);
?>




<script>

//    if ($(window).width() < 768) {
//        //alert('Less than 960');
//        $(window).scroll(function () {
//            if ($(window).scrollTop() !== 0) {
//                //alert("footer visible");
//                $('nav').css({
//                    "position": "fixed",
//                    "top": "0"
//                            //"color":"#fff"
//                });
//                //alert();
//            } else {
//                //alert("footer invisible");
//                $('nav').css({
//                    "position": "relative"
//                });
//            }
//        });
//    }
//    else {
//        //alert('More than 960');
//    }

    function ScrollOnClick(scroll) {
        $('html, body').animate({
            scrollTop: $("#scroll_" + scroll).offset().top - 50
        }, 1000);
    }

    function insertChoicesToHeadbar() {
        var numChoices = 0;
        for (var i = 1; i <= <?= $i ?>; i++) {
            var checkValue = $('input[name="name_' + i + '"]');
            if ($('input[name="name_' + i + '"]').is(':checked')) {
                numChoices++;
            }
        }
        $('numQuestion').text(numChoices);
    }

    $(document).ready(function () {
        $('numQuestionAll').text('<?= $i ?>');
        $('numQuestion').text('0');
    });

    function HideBottomMenu() {

        $(".examButtonMenu").slideToggle("slow");
        $('.showBottomMenu').hide();
        $('.onclickShowBottomMenu').slideToggle("slow");

    }

    function ShowBottomMenu() {
        $('.onclickShowBottomMenu').hide();
        $('.showBottomMenu').hide();
        $(".examButtonMenu").slideToggle("slow");
        
        setTimeout(function () {
            $('.showBottomMenu').show();
        }, 1500);
    }


</script>