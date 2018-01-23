<?php

use frontend\models\QuestionSet;
use frontend\widgets\LoadViewQuestion;
use frontend\widgets\ExamMenuLeft;
use frontend\widgets\HeaderMenuRight;
use frontend\widgets\BottomMenuCenter;
use frontend\widgets\LoadQuestionSave;
use frontend\widgets\BtnInsertAnswer;
use yii\web\View;
use frontend\widgets\QuestionAudio;

$this->title = $model->subject->exam_class . ' > ' . $model->subject->exam_subclass . ' > ' . $model->name;
?>


<?php
$i = 0;
foreach ( $questions as $question )
{
    $i++;
    if ( !empty($question) )
    {

        echo LoadViewQuestion::widget(['question' => $question, 'countDiv' => $question->id, 'questionSetID' => $model->id, 'countQuestion' => $i ]);
    }
}


echo HeaderMenuRight::widget(['countQuestion' => $i, 'questionSet' => $model, 'from' => $model->from, 'to' => $model->to ]);
echo BottomMenuCenter::widget(['countQuestion' => $i, 'questionSet' => $model, 'from' => $model->from, 'to' => $model->to ]);

$js = "   
        
        $('numQuestionAll').text('" . $i . "');
        $('numQuestion').text('0');
        display = document.querySelector('time');
        displayM = document.querySelector('time-m');
        countDown(" . ($model->total_time * 60 - $questionSave->elapse_time) . ",display, displayM);
         ";
$this->registerJs($js, View::POS_END);
?>

<script>
    function insertChoicesToHeadbar() {
        var numChoices = 0;
        for (var i = <?= $model->from ?>; i <= <?= $model->to ?>; i++) {
            var checkValue = $('input[name="name_' + i + '"]');
            if ($('input[name="name_' + i + '"]').is(':checked')) {
                numChoices++;
            }
        }
        $('numQuestion').text(numChoices);
    }
</script>
<br><br>

<?= LoadQuestionSave::widget(['questionSave' => $questionSave ]); ?>
<?= BtnInsertAnswer::widget(['from' => $model->from, 'to' => $model->to ]); ?>
<?= ExamMenuLeft::widget(['countQuestion' => $i, 'from' => $model->from, 'to' => $model->to, 'questionSet' => $model ]) ?>

<a class="question-from" data-id="<?= $model->from ?>"></a>
<a class="question-to" data-id="<?= $model->to ?>"></a>
<a class="question-set-id" data-id="<?= $model->id ?>"></a>
<a class="question-type" data-id="<?= $model->question_type ?>"></a>