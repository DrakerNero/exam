<?php

use frontend\helpers\MainHelper;
use frontend\models\Question;
//use frontend\models\User;
use frontend\models\QuestionSave;

$setRotation = MainHelper::setLotation();

header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="export_question_choices.xls"'); #ชื่อไฟล์
?>

<!--<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"   />-->
<HTML
  xmlns:o="urn:schemas-microsoft-com:office:office"
  xmlns:x="urn:schemas-microsoft-com:office:excel"
  >
  <HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
      td {
        mso-number-format:\@;
        border: 1px solid #000;
      }
    </style>
  </HEAD>
  <BODY>
    <b>รายละเอียดของหัวข้อการเลือกคำตอบ</b>
    1.2.3.4 <br />
    ทศนิยม 1 นับจำนวนสอบทั้งหมดของข้อสอบชุดนั้น <br />
    ทศนิยม 2 Case ของข้อสอบชุดนั้น <br />
    ทศนิยม 3 นับจำนวนข้อสอบที่อยู่ใน Case นั้น <br />
    ทศนิยม 4 Choice ที่อยู่ในข้อสอบชุดนั้น (โดย 1 ข้อสอบประกอดด้วย 15 choice) <br />
    <br /><br />
    <?php
    foreach ($questionSets as $questionSet) {
      $questions = Question::find()
              ->where(['>=', 'id', $questionSet->from])
              ->andWhere(['<=', 'id', $questionSet->to])
              ->all();
      ?>
      <table class="export-tb">
        <thead>
          <tr style="font-size: 16px; font-weight: 700;">
            <td>SID</td>
            <td>Year</td>
            <td>รุ่น</td>
            <td>ชื่อ-สกุล</td>
            <td>Exam Name</td>
            <td>Datetime </td>
            <td>Case</td>
            <?php
            $countQuestion = 1;
            $countPart = 0;
            $part = 1;
            foreach ($questions as $question) {
              $answers = json_decode($question->answers);
              $countChoice = 1;

              if ($question->part == $part) {
                $countPart++;
              } else {
                $part = $question->part;
                $countPart = 1;
              }

              foreach ($answers as $answer) {
                ?>
                <td><?= $countQuestion . '.' . $question->part . '.' . $countPart . '.' . $countChoice ?></td>
                <?php
                $countChoice++;
              }

              $countQuestion++;
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($academic == null && $rotation == null) {
            $models = QuestionSave::find()
                    ->where(['!=', 'module_part', ''])
                    ->andWhere(['question_set_id' => $questionSet->id])
                    ->all();
          } else {
            $models = QuestionSave::find()
                    ->where(['id' => $arrUserId, 'question_set_id' => $questionSet])
                    ->andWhere(['!=', 'module_part', ''])
                    ->all();
          }

          foreach ($models as $model) {
            $moduleParts = json_decode($model->module_part);
            $answers = json_decode($model->answer);
            $countModulePart = 0;
            ?>
            <tr>
              <td><?= $model->user->student_id ?></td>
              <td><?= $model->user->start_study ?></td>
              <td><?= $setRotation[$model->user->rotation] ?></td>
              <td><?= $model->user->first_name . '   ' . $model->user->last_name ?></td>
              <td><?= $questionSet->name ?></td>
              <td><?= date('Y-m-d H:i:s', $model->updated_at) ?></td>
              <td>
                <?php
                foreach ($moduleParts as $modulePart) {
                  echo ($countModulePart != 0) ? ', ' : '';
                  echo MainHelper::setNameModulePart($modulePart);
                  $countModulePart++;
                }
                ?>
              </td>
              <?php
              $questionAnswer = json_decode($model->answer);
              foreach ($questions as $question) {
                $answers = json_decode($question->answers);
                $countAnswer = 1;
                if (!empty($questionAnswer->{$question->id}->key) && isset($questionAnswer->{$question->id}->key) && $questionAnswer->{$question->id}->key != null) {
                  $valueAnswer = json_decode($questionAnswer->{$question->id}->value);
                } else {
                  
                }

                foreach ($answers as $answer) {
                  ?>
                  <td><?php
                    if (!empty($questionAnswer->{$question->id}->key) && isset($questionAnswer->{$question->id}->key) && $questionAnswer->{$question->id}->key != null) {
                      if (in_array($countAnswer, $valueAnswer)) {
                        echo 1;
                      } else {
                        echo 0;
                      }
//                      echo $questionAnswer->{$question->id}->key;
                    } else {
                      
                    }
                    ?></td>
                  <?php
                  $countAnswer++;
                }
              }
              ?>
            </tr>
            <?php
          }
          ?>

        </tbody>
      </table>


      <?php
      echo '<br /> <br />';
    }
    ?>
    <?php ?>
  </BODY>

</HTML>

