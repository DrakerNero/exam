<?php

use frontend\components\Actions;

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
          <td>Datetime</td>
          <?php
          $count = 0;
          for ($i = $models[0]->questionset2->from; $i <= $models[0]->questionset2->to; $i++) {
            $count++;
            echo '<td>' . $count . '</td>';
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Year</td>
          <td>รุ่น</td>
          <td>SID</td>
          <td>Datetime</td>
          <?php
          for ($i = $models[0]->questionset2->from; $i <= $models[0]->questionset2->to; $i++) {
            if (!empty($answers->{$i}) && isset($answers->{$i})) {
              echo '<td>' . $answers->{$i}->value . '</td>';
            } else {
              echo '<td></td>';
            }
          }
          ?>
        </tr>
      </tbody>
    </table>
    <?php ?>
  </BODY>

</HTML>

