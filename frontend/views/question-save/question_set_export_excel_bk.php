<?php

use frontend\helpers\MainHelper;

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
    <table class="export-tb">
      <thead>
        <tr style="font-size: 16px; font-weight: 700;">
          <td>Year</td>
          <td>รุ่น</td>
          <td>SID</td>
          <td>Question Set</td>
          <td>Datetime </td>
          <td>Case</td>
          <?php
          for ($i = 1; $i <= 200; $i++) {
            for ($i2 = 1; $i2 <= 15; $i2++) {
              echo '<td>' . $i . '.' . $i2 . '</td>';
            }
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($models as $model) {
          $moduleParts = json_decode($model->module_part);
          $answers = json_decode($model->answer);
          $countModulePart = 0;
          ?>
          <tr>
            <td><?= $model->user->start_study ?></td>
            <td><?= $model->user->rotation ?></td>
            <td><?= $model->user->student_id ?></td>
            <td><?= $model->question_set_id ?></td>
            <td><?= date('Y-m-d H:i:s', $model->updated_at) ?></td>
            <td><?php
              foreach ($moduleParts as $modulePart) {
                echo ($countModulePart != 0) ? ', ' : '';
                echo MainHelper::setNameModulePart($modulePart);
                $countModulePart++;
              }
              ?></td>
            <?php
            for ($i = $model->questionset2->from; $i <= $model->questionset2->to; $i++) {
              if (!empty($answers->{$i}) && isset($answers->{$i})) {
                $choice = array_values(json_decode($answers->{$i}->value, true));
                for ($i2 = 0; $i2 <= 14; $i2++) {
                  $choiceCheck = (!empty($choice[$i2]) && isset($choice[$i2])) ? 1 : 0;
                  echo '<td>' . $choiceCheck . '</td>';
                }
              } else {
                for ($i2 = 0; $i2 <= 14; $i2++) {
                  echo '<td>' . 0 . '</td>';
                }
              }
            }
            ?>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <?php ?>
  </BODY>

</HTML>

